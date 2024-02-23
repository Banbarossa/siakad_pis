<?php

namespace App\Livewire\Student\Cetak;

use App\Models\Lembaga;
use App\Models\PengajuanSurat;
use App\Models\Student;
use App\Traits\JenisSuratTrait;
use App\Traits\RomanMonthTrait;
use App\Traits\SemesterAktif;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class SuratAktif extends Component
{

    use RomanMonthTrait;
    use LivewireAlert;
    use SemesterAktif;

    public $pengajuan;

    #[Validate('required', '', '', 'Keperluan Wajib Diisi')]
    public $keperluan;

    public $perPage = 10;

    use JenisSuratTrait;
    use LivewireAlert;

    #[Layout('layouts.app')]
    public function render()
    {

        $student = Student::login()->first();
        $surat = PengajuanSurat::where('student_id', $student->id)->latest()->paginate($this->perPage);

        return view('livewire.student.cetak.surat-aktif', [
            'surat' => $surat,
        ]);
    }

    public function store()
    {

        $this->validate();

        $student = Student::login()->first();

        $ayah = $student->guardians()->wherePivot('type', 'ayah')->limit(1)->first();

        $lembaga = Lembaga::latest()->first();

        $tahun = $this->getAktifSemester();

        $tahun = $tahun->tahunAjaran->tahun;

        $ttl = $student->tempat_lahir . ', ' . Carbon::parse($student->tanggal_lahir)->format('d/m/Y');

        $alamat = '';

        if ($student->village) {
            $alamat = 'Desa ' . $student->village->name . ' Kecamatan ' . $student->village->district->name . ' Kabutapen ' . $student->village->district->regency->name . ' Provinsi ' . $student->village->district->regency->province->name;
        }

        //generate Nomor
        $nomor_terakhir = PengajuanSurat::whereYear('created_at', Carbon::now()->format('Y'))->latest()->first();
        if ($nomor_terakhir) {
            $no_urut = $nomor_terakhir->no_urut + 1;
        } else {
            $no_urut = 1;
        }

        // Ambil dari trait

        $bulan = Carbon::now()->format('n');

        $romanMonth = $this->convertToRoman($bulan);
        $no_surat = str_pad($no_urut, 3, '0', STR_PAD_LEFT) . '/PIS/' . $romanMonth . '/' . Carbon::now()->format('Y');

        $pengajuan = new PengajuanSurat();
        $pengajuan->kode_unik = Str::uuid();
        $pengajuan->no_urut = $no_urut;
        $pengajuan->student_id = $student->id;
        $pengajuan->nomor_surat = $no_surat;
        $pengajuan->jenis_surat = 'Surat Aktif';
        $pengajuan->keperluan = $this->keperluan;
        $pengajuan->alamat = $alamat;

        $pengajuan->nama = $student->nama;
        $pengajuan->ttl = $ttl;
        $pengajuan->nisp_nisn = $student->nis_pesantren . '/' . $student->nisn;
        // $pengajuan->kelas = ....;
        $pengajuan->nama_ayah = $ayah ? $ayah->nama : '';
        $pengajuan->pekerjaan_ayah = $ayah ? $ayah->pekerjaan : '';
        $pengajuan->tahun_pelajaran = $tahun;
        $pengajuan->nama_tt = $lembaga ? $lembaga->nama_pimpinan : '';
        $pengajuan->nupl_tt = $lembaga ? $lembaga->nip_pimpinan : '';
        $pengajuan->save();

        $this->alert('success', 'success');
        $this->dispatch('close-modal');
        $this->keperluan = '';

    }

    public function cetak($id)
    {
        $this->pengajuan = PengajuanSurat::with('student')->where('id', $id)->first();
    }

    public function generateSurat()
    {
        $pdf = Pdf::loadView('rapor')->setPaper('a4', 'potrait');
        return $pdf->stream();
    }

}
