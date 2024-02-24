<?php

namespace App\Livewire\Admin\Siswa;

use App\Models\District;
use App\Models\Guardian;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Student;
use App\Models\User;
use App\Models\Village;
use App\Traits\ColumnSantri;
use App\Traits\DaftarPekerjaan;
use App\Traits\OptionPendidikan;
use App\Traits\OptionPenghasilan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;

class TambahSiswa extends Component
{
    public $title = 'Tambah Santri';

    use LivewireAlert;
    use ColumnSantri;
    use DaftarPekerjaan;
    use OptionPenghasilan;
    use OptionPendidikan;

    public $level = 1;
    // Form Level 1 =Profile
    public $nama, $nisn, $nis_sekolah, $nis_pesantren, $jenis_kelamin = 'laki laki', $nik, $tempat_lahir, $tanggal_lahir, $tahun_masuk, $status_sosial, $status_rumah, $is_asrama = 1, $nomor_yatim, $no_kk, $hubungan_keluarga, $anak_ke, $dari_jumlah_saudara, $jumlah_saudara_laki_laki, $jumlah_saudara_perempuan, $nomor_registrasi_akte_lahir, $hobi, $cita_cita, $tinggi_badan, $berat_badan, $golongan_darah;

    // Form Level 2 => ayah
    public $ayah_nama, $ayah_nik, $ayah_tempat_lahir, $ayah_tanggal_lahir, $ayah_pendidikan, $ayah_pekerjaan, $ayah_penghasilan, $ayah_contact;

    // Form Level 3 => ibu
    public $ibu_nama, $ibu_nik, $ibu_tempat_lahir, $ibu_tanggal_lahir, $ibu_pendidikan, $ibu_pekerjaan, $ibu_penghasilan, $ibu_contact;

    // form level 4 => alamat
    public $province_id, $regency_id, $district_id, $village_id, $kode_pos, $alamat;

    // form level 5 => akun
    public $email, $password, $password_confirmation;

    #[Title('Tambah Santri')]
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
        return view('livewire.admin.siswa.tambah-siswa', [
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

    // public function updated()
    // {
    //     $nama = $this->nama;
    //     $cleanNama = strtolower($nama);
    //     $cleanNama = str_replace(' ', '', $cleanNama);
    //     $cleanNama = preg_replace('/[^a-z0-9]/', '', $cleanNama);
    //     $email = $cleanNama . '@pis.sch.id';
    //     $findemail = User::where('email', $email)->get();
    //     if ($findemail->count() > 0) {
    //         $tigaKarakterAkhirNisn = substr($this->nisn, -3);
    //         $this->email = $cleanNama . $tigaKarakterAkhirNisn . '@pis.sch.id';
    //     } else {
    //         $this->email = $email;
    //     }

    //     $this->password = Carbon::parse($this->tanggal_lahir)->format('dmY');

    // }

    public function FirstLevelValidation()
    {

        $this->validate([
            'nama' => 'required:min:3',
            'nisn' => 'required|digits:10|unique:students,nisn',
            'nis_sekolah' => 'required',
            'nis_pesantren' => 'required|unique:students,nis_pesantren',
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
        ]);

        $this->level = 2;

    }

    public function validasiAyah()
    {
        $this->validate([
            'ayah_nama' => 'required',
            'ayah_nik' => 'required',
        ], [
            'ayah_nama.required' => 'Nama Ayah wajib diisi',
            'ayah_nik.required' => 'NIK Ayah wajib diisi',
        ]);
        $this->level = 3;
    }

    public function validasiIbu()
    {
        $this->validate([
            'ibu_nama' => 'required',
            'ibu_nik' => 'required',
        ], [
            'ibu_nama.required' => 'Nama Ibu wajib diisi',
            'ibu_nik.required' => 'NIK Ibu wajib diisi',
        ]);
        $this->level = 4;
    }

    public function validasiAlamat()
    {
        $this->validate([
            'province_id' => 'required',
            'regency_id' => 'required',
            'district_id' => 'required',
            'village_id' => 'required',
            'kode_pos' => 'nullable|numeric',
            'alamat' => 'nullable',
        ], [
            'province_id.required' => 'Provinsi Wajib dipilih',
            'regency_id.required' => 'Kabupaten Wajib dipilih',
            'district_id.required' => 'Kecamatan Wajib dipilih',
            'village_id.required' => 'Desa Wajib dipilih',
            'kode_pos.numeric' => 'Kode Pos wajib berupa nomor',
        ]);
        $this->level = 5;
    }

    public function storeData()
    {
        $this->validate([
            'email' => 'nullable|email|unique:users,email',
            'password' => 'min:6',
            'password_confirmation' => 'required_with:password|same:password|min:6',
        ], [
            'email.required' => 'Email Wajib Diisi',
            'email.email' => 'Wajib berupa email',
            'email.unique' => 'Email ini sudah digunakan',
            // 'password.required' => 'Password Wajib Diisi',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Konfirmasi Password Wajid Diisi',
        ]);

        // $this->level = 3;
        try {
            DB::beginTransaction();

            $user = new User();
            $user->name = $this->nama;
            $user->email = $this->email;
            $user->username = $this->nisn;
            $user->password = Hash::make($this->password);
            $user->level = 'student';
            $user->is_aktif = true;
            $user->save();

            // Create Student
            $student = new Student();
            $student->user_id = $user->id;
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
            $student->kode_pos = $this->kode_pos;
            $student->alamat = $this->alamat;
            $student->status_siswa = 'aktif';
            $student->save();

            $user->students()->attach($student->id, ['type' => 'student']);

            $ayah = Guardian::firstOrNew([
                'type' => 'ayah',
                'nik' => $this->ayah_nik,
            ], [
                'nama' => $this->ayah_nama,
                'student_id' => $student->id,
                'tempat_lahir' => $this->ayah_tempat_lahir,
                'tanggal_lahir' => $this->ayah_tanggal_lahir,
                'pendidikan' => $this->ayah_pendidikan,
                'pekerjaan' => $this->ayah_pekerjaan,
                'penghasilan' => $this->ayah_penghasilan,
                'contact' => $this->ayah_contact,
                'village_id' => $this->village_id,
                'kode_pos' => $this->kode_pos,
                'alamat' => $this->alamat,
            ]);
            $ayah->save();

            $student->guardians()->attach($ayah->id, ['type' => 'ayah']);

            $ibu = Guardian::firstOrNew([
                'type' => 'ibu',
                'nik' => $this->ibu_nik,
            ], [
                'nama' => $this->ibu_nama,
                'student_id' => $student->id,
                'tempat_lahir' => $this->ibu_tempat_lahir,
                'tanggal_lahir' => $this->ibu_tanggal_lahir,
                'pendidikan' => $this->ibu_pendidikan,
                'pekerjaan' => $this->ibu_pekerjaan,
                'penghasilan' => $this->ibu_penghasilan,
                'contact' => $this->ibu_contact,
                'village_id' => $this->village_id,
                'kode_pos' => $this->kode_pos,
                'alamat' => $this->alamat,
            ]);
            $ibu->save();

            $student->guardians()->attach($ibu->id, ['type' => 'ibu']);

            DB::commit();

            $this->alert('success', 'Data Berhasil Ditambahakan');
            return redirect()->route('admin.siswa.aktif');
        } catch (\Throwable $th) {
            DB::rollback();

            $this->alert('error', 'Data Tidak Dapat Ditambahakan terjadi error ' . $th->getMessage());
            return;
        }

    }

}
