<?php

namespace App\Livewire\Admin\Siswa;

use App\Models\District;
use App\Models\Guardian;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Student;
use App\Models\User;
use App\Models\Village;
use App\Traits\DaftarPekerjaan;
use App\Traits\OptionPendidikan;
use App\Traits\OptionPenghasilan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;

class ShowStudentDetail extends Component
{
    use OptionPendidikan;
    use DaftarPekerjaan;
    use OptionPenghasilan;
    use LivewireAlert;

    public $student, $guardian_id;

    public $level = 1;

    // getGuardian
    public $nama, $nik, $tempat_lahir, $tanggal_lahir, $pendidikan, $pekerjaan, $penghasilan, $contact;

    public $province_id, $regency_id, $district_id, $village_id, $kode_pos, $alamat;

    public $type;

    public $akun_id, $akun_name, $akun_email, $akun_username, $new_password;

    // public $status;

    public function mount($id)
    {
        $student = Student::with('village.district.regency.province', 'akun')->findOrFail($id);

        // dd($student->akun);
        $this->student = $student;
        if ($student->akun) {
            $this->akun_id = $student->akun->id;
            $this->akun_name = $student->akun->name;
            $this->akun_email = $student->akun->email;
            $this->akun_username = $student->akun->username;
        }

    }

    #[Title('Detail Siswa')]
    public function render()
    {
        $student = $this->student;

        $ayah = $student->guardians()->wherePivot('type', 'ayah')->first();
        $ibu = $student->guardians()->wherePivot('type', 'ibu')->first();

        $wali = $student->guardians()->wherePivot('type', 'wali')->first();
        $akun = $student->akun;
        $daftar_pekerjaan = $this->pekerjaan();
        $daftar_penghasilan = $this->penghasilan();
        $daftar_pendidikan = $this->pendidikan();
        $provincies = Province::all();
        $regencies = [];

        if ($this->province_id) {
            $regencies = Regency::where('province_id', $this->province_id)->get();
        }

        $districts = [];

        if ($this->regency_id) {
            $districts = District::where('regency_id', $this->regency_id)->get();
        }

        $villages = [];
        if ($this->district_id) {
            $villages = Village::where('district_id', $this->district_id)->get();
        }

        return view('livewire.admin.siswa.show-student-detail', compact('student', 'ayah', 'ibu', 'wali', 'daftar_pendidikan', 'daftar_penghasilan', 'daftar_pekerjaan', 'provincies', 'regencies', 'districts', 'villages', 'akun'));
    }

    public function clearGuardian()
    {
        $this->nama = '';
        $this->nik = '';
        $this->tempat_lahir = '';
        $this->tanggal_lahir = '';
        $this->pendidikan = '';
        $this->pekerjaan = '';
        $this->penghasilan = '';
        $this->contact = '';
        $this->province_id = '';
        $this->regency_id = '';
        $this->district_id = '';
        $this->village_id = '';
        $this->kode_pos = '';
        $this->alamat = '';

    }

    public function updateLevel($level)
    {

        $this->level = $level;
    }

    public function rules()
    {
        return [
            'nama' => 'required',
            'nik' => 'required|unique:guardians,nik',
        ];
    }

    public function updateType($type)
    {
        $this->type = $type;
    }

    public function storeGuardian()
    {
        $this->validate();
        $guardian = new Guardian;
        $guardian->type = $this->type;
        $guardian->nama = $this->nama;
        $guardian->nik = $this->nik;
        $guardian->tempat_lahir = $this->tempat_lahir;
        $guardian->tanggal_lahir = $this->tanggal_lahir;
        $guardian->pendidikan = $this->pendidikan;
        $guardian->pekerjaan = $this->pekerjaan;
        $guardian->penghasilan = $this->penghasilan;
        $guardian->contact = $this->contact;
        $guardian->village_id = $this->village_id;
        $guardian->alamat = $this->alamat;
        $guardian->kode_pos = $this->kode_pos;
        $guardian->save();

        $guardian->students()->attach($this->student->id, ['type' => $this->type]);
        $this->alert('success', 'Data Berhasil di tambah');
        $this->dispatch('close-modal');

    }

    public function getGuardian($id)
    {
        $guardian = Guardian::find($id);
        $this->guardian_id = $guardian->id;
        $this->nama = $guardian->nama;
        $this->nik = $guardian->nik;
        $this->tempat_lahir = $guardian->tempat_lahir;
        $this->tanggal_lahir = $guardian->tanggal_lahir;
        // $this->status = $guardian->status;
        $this->pendidikan = $guardian->pendidikan;
        $this->pekerjaan = $guardian->pekerjaan;
        $this->penghasilan = $guardian->penghasilan;
        $this->contact = $guardian->contact;
        $this->village_id = $guardian->village_id;
        $this->alamat = $guardian->alamat;
        $this->kode_pos = $guardian->kode_pos;

    }

    public function updateData()
    {
        $this->validate([
            'nama' => 'required',
        ]);
        $guardian = Guardian::find($this->guardian_id);
        $guardian->nama = $this->nama;
        $guardian->nik = $this->nik;
        $guardian->tempat_lahir = $this->tempat_lahir;
        $guardian->tanggal_lahir = $this->tanggal_lahir;
        // $this->status = $guardian->status;
        $guardian->pendidikan = $this->pendidikan;
        $guardian->pekerjaan = $this->pekerjaan;
        $guardian->penghasilan = $this->penghasilan;
        $guardian->contact = $this->contact;
        $guardian->village_id = $this->village_id;
        $guardian->alamat = $this->alamat;
        $guardian->kode_pos = $this->kode_pos;
        $guardian->save();

        $this->alert('success', 'Data ' . ucfirst($guardian->type) . ' Berhasil di ubah');
        $this->dispatch('close-modal');
    }

    public function updateAkun()
    {
        $this->validate([
            'akun_name' => ['required', 'min:5'],
            'akun_email' => ['nullable', 'email', Rule::unique(User::class, 'email')->ignore($this->akun_id)],
            'akun_username' => ['required', Rule::unique(User::class, 'username')->ignore($this->akun_id)],
        ], [
            'akun_name.required' => 'Nama Akun Wajib di isi',
            'akun_name.min' => 'Nama minimal 5 karakter',
            'akun_email.email' => 'Wajib format email',
            'akun_username.required' => 'Username/NISN Wajib di isi',
        ]);

        $user = User::findOrFail($this->akun_id);
        $user->name = $this->akun_name;
        $user->email = $this->akun_email;
        $user->username = $this->akun_username;
        $user->save();

        $this->alert('success', 'Akun Berhasil Di Update');

    }

    public function updatePassword()
    {
        $this->validate([
            'new_password' => ['required', 'min:6'],
        ]);
        $user = User::findOrFail($this->akun_id);

        $user->password = Hash::make($this->new_password);

        dd($user->password);
        $user->save();

        $this->alert('success', 'Password Berhasil Di Update');

    }
}
