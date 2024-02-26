<?php

namespace App\Livewire\Admin\Pegawai;

use App\Models\District;
use App\Models\Pegawai;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Typepegawai;
use App\Models\Village;
use App\Traits\DaftarPekerjaan;
use App\Traits\OptionPendidikan;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;

class UpdatePegawai extends Component
{
    use LivewireAlert, DaftarPekerjaan, OptionPendidikan;
    public $level = 1;
    public $title = 'Update Data Pegawai';

    public $pegawai_id;

    public $required_akun;

    // profil level 1
    public $nupl, $nama, $no_kk, $no_nik, $tempat_lahir, $tanggal_lahir, $pendidikan_terakhir, $lulusan, $tmt, $jabatan, $status_nikah, $jenis_kelamin = 'laki laki', $typepegawai_id;

    // validasi Alamat
    public $village_id, $alamat, $kode_pos;

    // validasi Alamat
    public $email, $password, $password_confirmation;

    // cari validasiAlamat
    public $province_id, $regency_id, $district_id;

    public function mount($id = false)
    {
        if ($id) {
            $pegawai = Pegawai::find($id);
            $this->pegawai_id = $pegawai->id;
            $this->nupl = $pegawai->nupl;
            $this->nama = $pegawai->nama;
            $this->no_kk = $pegawai->no_kk;
            $this->no_nik = $pegawai->no_nik;
            $this->tempat_lahir = $pegawai->tempat_lahir;
            $this->tanggal_lahir = $pegawai->tanggal_lahir;
            $this->pendidikan_terakhir = $pegawai->pendidikan_terakhir;
            $this->lulusan = $pegawai->lulusan;
            $this->tmt = $pegawai->tmt;
            $this->jabatan = $pegawai->jabatan;
            $this->status_nikah = $pegawai->status_nikah;
            $this->jenis_kelamin = $pegawai->jenis_kelamin;
            $this->typepegawai_id = $pegawai->typepegawai_id;
            $this->province_id = $pegawai->village->district->regency->province->id ?? null;
            $this->regency_id = $pegawai->village->district->regency->id ?? null;
            $this->district_id = $pegawai->village->district->id ?? null;
            $this->village_id = $pegawai->village->id ?? null;
            $this->alamat = $pegawai->alamat;
            $this->kode_pos = $pegawai->kode_pos;

        } else {
            $pegawai = new Pegawai();
        }
    }

    #[Title('Update Pegawai')]
    public function render()
    {
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

        $pendidikan = $this->pendidikan();
        $daftar_pekerjaan = $this->pekerjaan();

        $type_pegawai = Typepegawai::orderBy('primary_type', 'asc')->get();
        return view('livewire.admin.pegawai.tambah-pegawai', compact('daftar_pekerjaan', 'pendidikan', 'provincies', 'regencies', 'districts', 'villages', 'type_pegawai'));

    }

    public function validasiProfile()
    {
        $this->validate([
            'nupl' => 'required',
            'nama' => 'required|max:255',
            'no_kk' => 'nullable|digits:16|numeric',
            'no_nik' => 'nullable|digits:16|numeric',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'pendidikan_terakhir' => 'required',
            'lulusan' => 'required',
            'tmt' => 'required',
            // 'jabatan' => 'required',
            'status_nikah' => 'required',
            'jenis_kelamin' => 'required',
            'typepegawai_id' => 'required',
        ]);

        $this->level = 2;
    }

    public function validasiAlamat()
    {
        $this->validate([
            'village_id' => 'required',
            'alamat' => 'nullable',
            'kode_pos' => 'nullable|numeric',

        ]);

        $this->level = 3;
    }

    public function storeData()
    {

        $pegawai = Pegawai::find($this->pegawai_id);
        // $pegawai->user_id = $user->id;
        $pegawai->nupl = $this->nupl;
        $pegawai->nama = $this->nama;
        $pegawai->no_kk = $this->no_kk;
        $pegawai->no_nik = $this->no_nik;
        $pegawai->tempat_lahir = $this->tempat_lahir;
        $pegawai->tanggal_lahir = $this->tanggal_lahir;
        $pegawai->pendidikan_terakhir = $this->pendidikan_terakhir;
        $pegawai->lulusan = $this->lulusan;
        $pegawai->tmt = $this->tmt;
        $pegawai->jabatan = $this->jabatan;
        $pegawai->status_nikah = $this->status_nikah;
        $pegawai->jenis_kelamin = $this->jenis_kelamin;
        $pegawai->typepegawai_id = $this->typepegawai_id;
        $pegawai->village_id = $this->village_id;
        $pegawai->alamat = $this->alamat;
        $pegawai->kode_pos = $this->kode_pos;

        $pegawai->save();
        $this->alert('success', 'Data berhasil Di ubah');
        $this->redirect('/admin/pegawai/show/' . $pegawai->id, navigate: false);

    }

}
