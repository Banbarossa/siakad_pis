<?php

namespace App\Livewire\Admin\Pegawai;

use App\Models\District;
use App\Models\Pegawai;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Typepegawai;
use App\Models\User;
use App\Models\Village;
use App\Traits\DaftarPekerjaan;
use App\Traits\OptionPendidikan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;

class TambahPegawai extends Component
{
    use LivewireAlert, DaftarPekerjaan, OptionPendidikan;
    public $title = 'Tambah data Pegawai';

    public $level = 1;

    public $required_akun = true;

    // profil level 1
    public $nupl, $nama, $no_kk, $no_nik, $tempat_lahir, $tanggal_lahir, $pendidikan_terakhir, $lulusan, $tmt, $jabatan, $status_nikah, $jenis_kelamin = 'laki laki', $typepegawai_id;

    // validasi Alamat
    public $village_id, $alamat, $kode_pos;

    // validasi Alamat
    public $email, $password, $password_confirmation;

    // cari validasiAlamat
    public $province_id, $regency_id, $district_id;

    #[Title('Tambah Santri')]
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

        if ($this->tmt) {
            $this->nupl = '03' . Carbon::parse($this->tmt)->format('Ymd');
        }

        $type_pegawai = Typepegawai::orderBy('primary_type', 'asc')->get();
        return view('livewire.admin.pegawai.tambah-pegawai', compact('daftar_pekerjaan', 'pendidikan', 'provincies', 'regencies', 'districts', 'villages', 'type_pegawai'));
    }

    public function validasiProfile()
    {
        $this->validate([
            'nupl' => 'nullable|digits:11',
            'nama' => 'required|max:255',
            'no_kk' => 'required|digits:16|numeric',
            'no_nik' => 'required|digits:16|numeric|unique:pegawais,no_nik',
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
        $this->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|same:password',

        ]);

        try {
            DB::beginTransaction();
            $user = new User();
            $user->name = $this->nama;
            $user->email = $this->email;
            $user->username = $this->nupl;
            $user->password = Hash::make($this->password);
            $user->level = 'admin';
            $user->is_aktif = true;
            $user->save();

            $pegawai = new Pegawai();
            $pegawai->user_id = $user->id;
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
            $this->alert('success', 'Data berhasil Di tambahkan');
            $this->redirect(route('admin.pegawai.index'), navigate: false);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->alert('error', 'Data tidak Dapat ditambahakan, Error ' . $th->getMessage());
            return;
        }

    }
}
