<?php

namespace App\Livewire\Admin\Siswa;

use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Student;
use App\Models\Village;
use App\Traits\ColumnSantri;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;

class EditSiswa extends Component
{
    use ColumnSantri;
    use LivewireAlert;
    public $title = 'Edit Profile Santri';

    public $student_id;
    public $nama, $nisn, $nis_sekolah, $nis_pesantren, $jenis_kelamin = 'laki laki', $nik, $tempat_lahir, $tanggal_lahir, $tahun_masuk, $status_sosial, $status_rumah, $is_asrama = 1, $nomor_yatim, $no_kk, $hubungan_keluarga, $anak_ke, $dari_jumlah_saudara, $jumlah_saudara_laki_laki, $jumlah_saudara_perempuan, $nomor_registrasi_akte_lahir, $hobi, $cita_cita, $tinggi_badan, $berat_badan, $golongan_darah;

    public $province_id, $regency_id, $district_id, $village_id, $alamat, $kode_pos;

    public function mount($id)
    {
        $student = Student::where('status_siswa', 'aktif')->where('id', $id)->first();
        $this->student_id = $student->id;
        $this->nama = $student->nama;
        $this->nisn = $student->nisn;
        $this->nis_sekolah = $student->nis_sekolah;
        $this->nis_pesantren = $student->nis_pesantren;
        $this->jenis_kelamin = $student->jenis_kelamin;
        $this->nik = $student->nik;
        $this->tempat_lahir = $student->tempat_lahir;
        $this->tanggal_lahir = $student->tanggal_lahir;
        $this->tahun_masuk = $student->tahun_masuk;
        $this->status_sosial = $student->status_sosial;
        $this->status_rumah = $student->status_rumah;
        $this->is_asrama = $student->is_asrama;
        $this->nomor_yatim = $student->nomor_yatim;
        $this->no_kk = $student->no_kk;
        $this->hubungan_keluarga = $student->hubungan_keluarga;
        $this->anak_ke = $student->anak_ke;
        $this->dari_jumlah_saudara = $student->dari_jumlah_saudara;
        $this->jumlah_saudara_laki_laki = $student->jumlah_saudara_laki_laki;
        $this->jumlah_saudara_perempuan = $student->jumlah_saudara_perempuan;
        $this->nomor_registrasi_akte_lahir = $student->nomor_registrasi_akte_lahir;
        $this->hobi = $student->hobi;
        $this->cita_cita = $student->cita_cita;
        $this->tinggi_badan = $student->tinggi_badan;
        $this->berat_badan = $student->berat_badan;
        $this->golongan_darah = $student->golongan_darah;
        $this->province_id = $student->village->district->regency->province->id ?? null;
        $this->regency_id = $student->village->district->regency->id ?? null;
        $this->district_id = $student->village->district->id ?? null;
        $this->village_id = $student->village->id ?? null;
        $this->alamat = $student->alamat;
        $this->kode_pos = $student->kode_pos;

    }

    #[Title('Edit profile Santri')]
    public function render()
    {
        $province = Province::all();
        $regency = [];

        if ($this->province_id) {
            $regency = Regency::where('province_id', $this->province_id)->get();
        }

        $district = [];

        if ($this->regency_id) {
            $district = District::where('regency_id', $this->regency_id)->get();
        }

        $village = [];
        if ($this->district_id) {
            $village = Village::where('district_id', $this->district_id)->get();
        }

        $primaryProfil = $this->primaryProfil();

        return view('livewire.admin.siswa.edit-siswa', compact('primaryProfil', 'province', 'regency', 'district', 'village'));
    }

    public function rules()
    {
        return [
            'nama' => 'required:min:3',
            'nisn' => 'required|digits:10',
            'nis_sekolah' => 'required',
            'nis_pesantren' => 'required',
            'jenis_kelamin' => 'required',
            'nik' => 'required|digits:16',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'tahun_masuk' => 'required',
            'status_sosial' => 'required',
            'status_rumah' => 'required',
            'is_asrama' => 'required',
            // 'nomor_yatim' => 'required',
            'no_kk' => 'required|digits:16',
            'hubungan_keluarga' => 'required',
            'anak_ke' => 'required',
            'dari_jumlah_saudara' => 'required',
            // 'jumlah_saudara_laki_laki' => 'required',
            // 'jumlah_saudara_perempuan' => 'required',
            'nomor_registrasi_akte_lahir' => 'required',
            // 'hobi' => 'required',
            // 'cita_cita' => 'required',
            // 'tinggi_badan' => 'required',
            // 'berat_badan' => 'required',
            // 'golongan_darah' => 'required',
        ];
    }

    public function FirstLevelValidation()
    {
        $this->validate();

        $student = Student::find($this->student_id);
        $student->nama = $this->nama;
        $student->nisn = $this->nisn;
        $student->nis_sekolah = $this->nis_sekolah;
        $student->nis_pesantren = $this->nis_pesantren;
        $student->jenis_kelamin = $this->jenis_kelamin;
        $student->nik = $this->nik;
        $student->tempat_lahir = $this->tempat_lahir;
        $student->tanggal_lahir = $this->tanggal_lahir;
        $student->tahun_masuk = $this->tahun_masuk;
        $student->status_sosial = $this->status_sosial;
        $student->status_rumah = $this->status_rumah;
        $student->is_asrama = $this->is_asrama;
        $student->nomor_yatim = $this->nomor_yatim;
        $student->no_kk = $this->no_kk;
        $student->hubungan_keluarga = $this->hubungan_keluarga;
        $student->anak_ke = $this->anak_ke;
        $student->dari_jumlah_saudara = $this->dari_jumlah_saudara;
        $student->jumlah_saudara_laki_laki = $this->jumlah_saudara_laki_laki;
        $student->jumlah_saudara_perempuan = $this->jumlah_saudara_perempuan;
        $student->nomor_registrasi_akte_lahir = $this->nomor_registrasi_akte_lahir;
        $student->hobi = $this->hobi;
        $student->cita_cita = $this->cita_cita;
        $student->tinggi_badan = $this->tinggi_badan;
        $student->berat_badan = $this->berat_badan;
        $student->golongan_darah = $this->golongan_darah;
        $student->village_id = $this->village_id;
        $student->alamat = $this->alamat;
        $student->kode_pos = $this->kode_pos;

        $student->save();
        $this->alert('success', 'Data berhasil diubah');
        return $this->redirect('/admin/santri/detail/' . $student->id, navigate: false);

    }
}
