<?php

namespace App\Livewire\Admin\Akun;

use App\Models\Student;
use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class AkunSiswa extends Component
{

    public $perPage = 15, $search;
    public $studentPage = 15, $studentSearch;
    public $sortColumn = 'name', $sortDirection = 'asc';
    use WithPagination;
    use LivewireAlert;
    protected $paginationTheme = 'bootstrap';

    public $akunUserId, $nama_akun, $email_akun;
    public $siswaId, $nama_siswa;

    public function render()
    {
        $users = User::with('students')->where('level', 'student')
            ->where('is_aktif', 1)
            ->orderBy($this->sortColumn, $this->sortDirection);

        if ($this->search) {
            $users = $users->where('name', 'like', '%' . $this->search . '%')->where('name', 'like', '%' . $this->search . '%');
        }
        $users = $users->paginate($this->perPage);

        $students = Student::siswaAktif();
        if ($this->akunUserId) {
            $students = Student::siswaAktif()->whereDoesntHave('users', function ($query) {
                $query->where('user_id', $this->akunUserId);
            });

        }

        if ($this->studentSearch) {
            $students = $students->where('nama', 'like', "%" . $this->studentSearch . "%");
        }
        $students = $students->paginate($this->studentPage);

        return view('livewire.admin.akun.akun-siswa', [
            'users' => $users,
            'students' => $students,
        ])->layout('layouts.admin-layout');
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

    public function detachStudent($user_id, $student_id)
    {
        $user = User::find($user_id);
        $student = User::find($student_id);
        $user->students()->detach($student);
        $this->alert('success', 'Siswa Berhasil di nonaktifkan dari user');

    }

    public function getUser($user_id)
    {
        $this->akunUserId = $user_id;
        $this->nama_akun = User::find($user_id)->name;
        $this->email_akun = User::find($user_id)->email;

    }

    public function attachSiswa($siswa_id)
    {
        $user = User::find($this->akunUserId);
        $user->students()->syncWithoutDetaching([$siswa_id]);

        $this->clear();
        $this->dispatch('close-modal');
        $this->alert('success', 'Siswa berhasil ditambahkan ke akun');
    }

    public function clear()
    {
        $this->akunUserId = '';
        $this->nama_akun = '';
        $this->siswaId = '';
        $this->nama_siswa = '';
    }

}
