<?php

namespace App\Livewire\Admin\Guru;

use App\Exports\GuruExport;
use App\Imports\GuruImport;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class KelolaGuru extends Component
{

    public $perPage = 15, $search;
    public $title = 'Guru';
    use LivewireAlert;
    use WithPagination;

    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $sortColumn = 'nama_lengkap', $sortDirection = 'asc';
    public $sekolah_id, $nama_sekolah, $tingkat, $user_id;
    public $file_import;
    public $guru_id, $email, $nama_lengkap, $gelar, $nip, $jenis_kelamin, $tempat_lahir, $tanggal_lahir, $alamat, $password, $avatar;

    #[Title('Data Guru')]
    public function render()
    {

        $data_guru = Guru::orderBy($this->sortColumn, $this->sortDirection)
            ->when($this->search, function ($query) {
                $query->search($this->search);
            })
            ->paginate($this->perPage);
        return view('livewire.admin.guru.kelola-guru', compact('data_guru'));
    }

    public function sortTable($column)
    {
        $this->sortColumn = $column;
        if ($this->sortDirection == 'asc') {
            $this->sortDirection = 'desc';
        } else {
            $this->sortDirection = 'asc';
        }
    }

    public function export()
    {
        $filename = 'data_guru ' . date('Y-m-d H_i_s') . '.xls';
        return Excel::download(new GuruExport, $filename);
    }

    public function downloadFormat()
    {
        $file = public_path() . "/format_import/format_import_guru.xls";
        $headers = array(
            'Content-Type: application/xls',
        );
        return Response::download($file, 'format_import_guru ' . date('Y-m-d H_i_s') . '.xls', $headers);
    }

    public function import()
    {

        try {
            Excel::import(new GuruImport, $this->file_import);

            $this->alert('success', 'Data Berhasil di Import');
        } catch (\Throwable $th) {

            $this->alert('error', 'Data Gagal di Import');
        }

    }

    public function rules()
    {
        return [
            'email' => 'required|email|unique:users,email',
            'nama_lengkap' => 'required|min:5',
            'gelar' => 'nullable',
            'nip' => 'nullable|digits:16',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'password' => 'nullable',
            'avatar' => 'nullable|image',
        ];
    }

    public function store()
    {
        $this->validate();

        $user = new User();
        $user->name = $this->nama_lengkap;
        $user->email = $this->email;
        $user->level = 'guru';
        $user->is_aktif = true;
        $user->password = Hash::make($this->password);
        $user->save();

        if (!$user) {
            $this->alert('error', 'Email sudah Terdaftar');
        }

        Guru::create([
            'user_id' => $user->id,
            'email' => $this->email,
            'nama_lengkap' => $this->nama_lengkap,
            'gelar' => $this->gelar,
            'nip' => $this->nip,
            'jenis_kelamin' => $this->jenis_kelamin,
            'tempat_lahir' => $this->tempat_lahir,
            'tanggal_lahir' => $this->tanggal_lahir,
            'alamat' => $this->alamat,
            'password' => Hash::make('GoAhead'),
            'avatar' => 'default.png',
        ]);
        $this->clear();
        $this->dispatch('close-modal');
        $this->alert('success', 'Data berhasil ditambahkan');

    }

    public function edit($id)
    {
        $guru = Guru::findOrFail($id);
        $this->guru_id = $id;
        $this->nama_lengkap = $guru->nama_lengkap;
        $this->gelar = $guru->gelar;
        $this->nip = $guru->nip;
        $this->jenis_kelamin = $guru->jenis_kelamin;
        $this->tempat_lahir = $guru->tempat_lahir;
        $this->tanggal_lahir = $guru->tanggal_lahir;
        $this->alamat = $guru->alamat;
        $this->password = $guru->password;
        $this->avatar = $guru->avatar;

    }

    public function update()
    {
        Guru::find($this->guru_id)->update([
            'nama_lengkap' => $this->nama_lengkap,
            'gelar' => $this->gelar,
            'nip' => $this->nip,
            'jenis_kelamin' => $this->jenis_kelamin,
            'tempat_lahir' => $this->tempat_lahir,
            'tanggal_lahir' => $this->tanggal_lahir,
            'alamat' => $this->alamat,
            'password' => $this->password,
            'avatar' => $this->avatar,
        ]);
        $this->clear();
        $this->dispatch('close-modal');
        $this->alert('success', 'Data berhasil diubah');
    }

    public function clear()
    {
        $this->email = '';
        $this->nama_lengkap = '';
        $this->gelar = '';
        $this->nip = '';
        $this->jenis_kelamin = '';
        $this->tempat_lahir = '';
        $this->tanggal_lahir = '';
        $this->alamat = '';
        $this->password = '';
        $this->avatar = '';
    }

    public function destroy($id)
    {
        Guru::findOrFail($id)->delete();
        $this->alert('success', 'Data berhasil dihapus');

    }
}
