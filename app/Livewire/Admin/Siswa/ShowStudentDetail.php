<?php

namespace App\Livewire\Admin\Siswa;

use App\Models\District;
use App\Models\Guardian;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Student;
use App\Models\Village;
use App\Traits\DaftarPekerjaan;
use App\Traits\OptionPendidikan;
use App\Traits\OptionPenghasilan;
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

    // public $status;

    public function mount($id)
    {
        $this->student = Student::with('village.district.regency.province')->findOrFail($id);
    }

    #[Title('Detail Siswa')]
    public function render()
    {
        $student = $this->student;

        $ayah = $student->guardians()->wherePivot('type', 'ayah')->first();
        $ibu = $student->guardians()->wherePivot('type', 'ibu')->first();

        $wali = $student->guardians()->wherePivot('type', 'wali')->first();
        $akun = $student->users()->get();
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
}
