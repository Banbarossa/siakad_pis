<?php

namespace App\Livewire\Admin\Santri;

use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Student;
use App\Models\User;
use App\Models\Village;
use App\Traits\ColumnSantri;
use App\Traits\DaftarPekerjaan;
use App\Traits\OptionPendidikan;
use App\Traits\OptionPenghasilan;
use Illuminate\Support\Facades\Hash;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class TambahSantri extends Component
{

    use LivewireAlert;
    use ColumnSantri;
    use DaftarPekerjaan;
    use OptionPenghasilan;
    use OptionPendidikan;

    public $level = 1;
    // Form Level 1
    public $nama, $nisn, $nis_sekolah, $nis_pesantren, $jenis_kelamin, $nik, $tempat_lahir, $tanggal_lahir, $tahun_masuk, $status_sosial, $status_rumah, $is_asrama, $nomor_yatim, $no_kk, $hubungan_keluarga, $anak_ke, $dari_jumlah_saudara, $jumlah_saudara_laki_laki, $jumlah_saudara_perempuan, $nomor_registrasi_akte_lahir, $hobi, $cita_cita, $tinggi_badan, $berat_badan, $golongan_darah;

    // Form Level 2

    public $ayah_nama, $ayah_nik, $ayah_tempat_lahir, $ayah_tanggal_lahir, $ayah_pendidikan, $ayah_pekerjaan, $ayah_penghasilan, $ayah_nomor_hp_wa, $ibu_nama, $ibu_nik, $ibu_tempat_lahir, $ibu_tanggal_lahir, $ibu_pendidikan, $ibu_pekerjaan, $ibu_penghasilan, $ibu_nomor_hp_wa;

    // form level 3
    public $province_id, $regency_id, $district_id, $village_id, $kode_pos, $alamat;

    // form level 4 akun
    public $email, $password, $password_confirmation;

    // Edit
    public $student_id;

    public function mount($id = false)
    {
        $this->student_id = $id;
        if ($id) {
            $student = Student::find($id);
            $this->nama = $student->nama;
            $this->nisn = $student->nisn;
            $this->nis_sekolah = $student->nis_sekolah;
            $this->nis_pesantren = $student->nis_pesantren;
            $this->jenis_kelamin = $student->jenis_kelamin;
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
            $this->ayah_nama = $student->ayah_nama;
            $this->ayah_nik = $student->ayah_nik;
            $this->ayah_tempat_lahir = $student->ayah_tempat_lahir;
            $this->ayah_tanggal_lahir = $student->ayah_tanggal_lahir;
            $this->ayah_pendidikan = $student->ayah_pendidikan;
            $this->ayah_pekerjaan = $student->ayah_pekerjaan;
            $this->ayah_penghasilan = $student->ayah_penghasilan;
            $this->ayah_nomor_hp_wa = $student->ayah_nomor_hp_wa;
            $this->ibu_nama = $student->ibu_nama;
            $this->ibu_nik = $student->ibu_nik;
            $this->ibu_tempat_lahir = $student->ibu_tempat_lahir;
            $this->ibu_tanggal_lahir = $student->ibu_tanggal_lahir;
            $this->ibu_pendidikan = $student->ibu_pendidikan;
            $this->ibu_pekerjaan = $student->ibu_pekerjaan;
            $this->ibu_penghasilan = $student->ibu_penghasilan;
            $this->ibu_nomor_hp_wa = $student->ibu_nomor_hp_wa;
            $this->province_id = $student->province_id;
            $this->regency_id = $student->regency_id;
            $this->district_id = $student->district_id;
            $this->village_id = $student->village_id;
            $this->kode_pos = $student->kode_pos;
            $this->alamat = $student->alamat;

        }

    }

    public function render()
    {
        $primaryProfil = $this->primaryProfil();
        $fieldAyah = $this->columnAyah();
        $fieldIbu = $this->columnIbu();
        $daftar_pekerjaan = $this->pekerjaan();
        $daftar_penghasilan = $this->penghasilan();
        $daftar_pendidikan = $this->pendidikan();

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

        return view('livewire.admin.santri.tambah-santri', [
            'primaryProfil' => $primaryProfil,
            'fieldAyah' => $fieldAyah,
            'fieldIbu' => $fieldIbu,
            'daftar_pekerjaan' => $daftar_pekerjaan,
            'daftar_penghasilan' => $daftar_penghasilan,
            'daftar_pendidikan' => $daftar_pendidikan,
            'provincies' => $province,
            'regencies' => $regency,
            'districts' => $district,
            'villages' => $village,
        ]);
    }

    public function tambahData()
    {
        $this->validate([
            'nama' => 'required',
            'nisn' => 'required|digits:10',
        ]);
        Student::create([
            'nama' => $this->nama,
            'ayah_nama' => $this->ayah_nama,
            'ibu_nama' => $this->ibu_nama,
        ]);

        $this->alert('success', 'Data Berhasil Di Tambahkan');

    }

    public function FirstLevelValidation()
    {

        $this->validate([
            'nama' => 'required:min:3',
            'nisn' => 'required|digits:10|unique:students,nisn',
            'nis_sekolah' => 'required',
            'nis_pesantren' => 'required|unique:students,nis_pesantren',
            'jenis_kelamin' => 'required',
            'nik' => 'nullable|digits:16',
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
            'jumlah_saudara_laki_laki' => 'required',
            'jumlah_saudara_perempuan' => 'required',
            'nomor_registrasi_akte_lahir' => 'required',
            // 'hobi' => 'required',
            // 'cita_cita' => 'required',
            // 'tinggi_badan' => 'required',
            // 'berat_badan' => 'required',
            'golongan_darah' => 'required',

        ]);

        $this->level = 2;

    }

    public function SecondLevelValidation()
    {
        $this->validate([
            'ayah_nama' => 'required',
            'ayah_nik' => 'required|digits:16',
            'ayah_tempat_lahir' => 'nullable',
            'ayah_tanggal_lahir' => 'nullable|date',
            'ayah_pendidikan' => 'nullable',
            'ayah_pekerjaan' => 'nullable',
            'ayah_penghasilan' => 'nullable',
            'ayah_nomor_hp_wa' => 'nullable',
            'ibu_nama' => 'required',
            'ibu_nik' => 'nullable|digits:16',
            'ibu_tempat_lahir' => 'nullable',
            'ibu_tanggal_lahir' => 'nullable|date',
            'ibu_pendidikan' => 'nullable',
            'ibu_pekerjaan' => 'nullable',
            'ibu_penghasilan' => 'nullable',
            'ibu_nomor_hp_wa' => 'nullable',
        ]);
        $this->level = 3;

    }

    public function thirdLevelValidation()
    {
        $this->validate([
            'province_id' => 'required',
            'regency_id' => 'required',
            'district_id' => 'required',
            'village_id' => 'required',
            'kode_pos' => 'required',
            'alamat' => 'required',
        ]);
        $this->level = 4;
    }

    public function AddSantri()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ], [
            'email.required' => 'Email Wajib diisi',
            'email.email' => 'Email wajib format email',
            'password.required' => 'Password Wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Password tidak sesuai dengan konfirmasi password',
        ]);

        // Create User
        $user = new User();
        $user->name = $this->nama;
        $user->email = $this->email;
        $user->password = Hash::make($this->password);
        $user->level = 'student';
        $user->is_aktif = true;
        $user->save();

        // Create Student
        $student = new Student();
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
        $student->ayah_nama = $this->ayah_nama;
        $student->ayah_nik = $this->ayah_nik;
        $student->ayah_tempat_lahir = $this->ayah_tempat_lahir;
        $student->ayah_tanggal_lahir = $this->ayah_tanggal_lahir;
        $student->ayah_pendidikan = $this->ayah_pendidikan;
        $student->ayah_pekerjaan = $this->ayah_pekerjaan;
        $student->ayah_penghasilan = $this->ayah_penghasilan;
        $student->ayah_nomor_hp_wa = $this->ayah_nomor_hp_wa;
        $student->ibu_nama = $this->ibu_nama;
        $student->ibu_nik = $this->ibu_nik;
        $student->ibu_tempat_lahir = $this->ibu_tempat_lahir;
        $student->ibu_tanggal_lahir = $this->ibu_tanggal_lahir;
        $student->ibu_pendidikan = $this->ibu_pendidikan;
        $student->ibu_pekerjaan = $this->ibu_pekerjaan;
        $student->ibu_penghasilan = $this->ibu_penghasilan;
        $student->ibu_nomor_hp_wa = $this->ibu_nomor_hp_wa;
        $student->province_id = $this->province_id;
        $student->regency_id = $this->regency_id;
        $student->district_id = $this->district_id;
        $student->village_id = $this->village_id;
        $student->kode_pos = $this->kode_pos;
        $student->alamat = $this->alamat;
        $student->status_siswa = 'aktif';
        $student->save();

        $user->students()->attach($student->id);

        $this->alert('success', 'Data Berhasil Ditambahakan');
        return redirect()->route('admin.santri.aktif');

    }

    public function updateData()
    {
        $this->validate([
            'province_id' => 'required',
            'regency_id' => 'required',
            'district_id' => 'required',
            'village_id' => 'required',
            'kode_pos' => 'required',
            'alamat' => 'required',
        ]);

        Student::find($this->student_id)->update([
            'nama' => $this->nama,
            'nisn' => $this->nisn,
            'nis_sekolah' => $this->nis_sekolah,
            'nis_pesantren' => $this->nis_pesantren,
            'jenis_kelamin' => $this->jenis_kelamin,
            'nik' => $this->nik,
            'tempat_lahir' => $this->tempat_lahir,
            'tanggal_lahir' => $this->tanggal_lahir,
            'tahun_masuk' => $this->tahun_masuk,
            'status_sosial' => $this->status_sosial,
            'status_rumah' => $this->status_rumah,
            'is_asrama' => $this->is_asrama,
            'nomor_yatim' => $this->nomor_yatim,
            'no_kk' => $this->no_kk,
            'hubungan_keluarga' => $this->hubungan_keluarga,
            'anak_ke' => $this->anak_ke,
            'dari_jumlah_saudara' => $this->dari_jumlah_saudara,
            'jumlah_saudara_laki_laki' => $this->jumlah_saudara_laki_laki,
            'jumlah_saudara_perempuan' => $this->jumlah_saudara_perempuan,
            'nomor_registrasi_akte_lahir' => $this->nomor_registrasi_akte_lahir,
            'hobi' => $this->hobi,
            'cita_cita' => $this->cita_cita,
            'tinggi_badan' => $this->tinggi_badan,
            'berat_badan' => $this->berat_badan,
            'golongan_darah' => $this->golongan_darah,
            'ayah_nama' => $this->ayah_nama,
            'ayah_nik' => $this->ayah_nik,
            'ayah_tempat_lahir' => $this->ayah_tempat_lahir,
            'ayah_tanggal_lahir' => $this->ayah_tanggal_lahir,
            'ayah_pendidikan' => $this->ayah_pendidikan,
            'ayah_pekerjaan' => $this->ayah_pekerjaan,
            'ayah_penghasilan' => $this->ayah_penghasilan,
            'ayah_nomor_hp_wa' => $this->ayah_nomor_hp_wa,
            'ibu_nama' => $this->ibu_nama,
            'ibu_nik' => $this->ibu_nik,
            'ibu_tempat_lahir' => $this->ibu_tempat_lahir,
            'ibu_tanggal_lahir' => $this->ibu_tanggal_lahir,
            'ibu_pendidikan' => $this->ibu_pendidikan,
            'ibu_pekerjaan' => $this->ibu_pekerjaan,
            'ibu_penghasilan' => $this->ibu_penghasilan,
            'ibu_nomor_hp_wa' => $this->ibu_nomor_hp_wa,
            'province_id' => $this->province_id,
            'regency_id' => $this->regency_id,
            'district_id' => $this->district_id,
            'village_id' => $this->village_id,
            'kode_pos' => $this->kode_pos,
            'alamat' => $this->alamat,
        ]);

        $this->alert('success', 'Data Berhasil Diubah');
        return redirect()->route('admin.santri.aktif');
    }
}
