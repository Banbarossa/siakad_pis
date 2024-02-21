<?php

namespace App\Livewire\Student\Cetak;

use App\Models\PengajuanSurat;
use App\Models\User;
use App\Traits\JenisSuratTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;

class SuratAktif extends Component
{
    public $pengajuan;
    public $search;
    public $siswa_id, $jenis_surat, $keperluan;

    use JenisSuratTrait;
    use LivewireAlert;

    public $authId;

    public function mount()
    {
        $this->authId = Auth::user()->id;
    }
    #[Layout('layouts.app')]
    public function render()
    {
        $surat = PengajuanSurat::with('pengajusurat', 'student')->where('diajukan_oleh', $this->authId)->latest();

        if ($this->search) {
            $surat = $surat->where(function ($query) {
                $query->whereHas('student', function ($studentQuery) {
                    $studentQuery->where('nama', 'like', '%' . $this->search . '%');
                })
                    ->orWhere('nomor_surat', 'like', '%' . $this->search . '%')
                    ->orWhere('jenis_surat', 'like', '%' . $this->search . '%')
                    ->orWhere('tanggal_pengajuan', 'like', '%' . $this->search . '%');
            });
        }
        $surat = $surat->paginate(15);

        $typeSurat = $this->typeSurat();

        $siswa = User::find($this->authId)->students()->get();

        return view('livewire.student.cetak.surat-aktif', [
            'surat' => $surat,
            'siswa' => $siswa,
            'typeSurat' => $typeSurat,
        ]);
    }

    public function cetak($id)
    {
        $this->pengajuan = PengajuanSurat::with('student')->where('id', $id)->first();
    }

    public function addData()
    {

        $this->validate([
            'siswa_id' => 'required',
            'jenis_surat' => 'required',
            'keperluan' => 'required',
        ], [
            'siswa_id.required' => 'Siswa Wajib Dipilih',
            'jenis_surat.required' => 'Jenis Surat Wajib Dipilih',
            'keperluan.required' => 'Keperluan Wajib diisi',
        ]);

        PengajuanSurat::create([
            'kode_surat' => Str::uuid(),
            'student_id' => $this->siswa_id,
            'jenis_surat' => $this->jenis_surat,
            'tanggal_pengajuan' => Carbon::now(),
            'keperluan' => $this->keperluan,
            'diajukan_oleh' => $this->authId,
        ]);
        $this->alert('success', 'Ajuan Berhasil dibuat');

        $this->dispatch('close-modal');
    }
}
