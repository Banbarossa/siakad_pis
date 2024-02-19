<?php

namespace App\Livewire\Admin\Akun;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Pegawai extends Component
{

    use LivewireAlert, WithPagination;
    public $sortColumn = 'name', $sortDirection = 'asc', $perPage = 15, $search;

    public $selectedRoles = [], $user_id;

    #[Title('Akun Pegawai')]
    public function render()
    {
        $users = User::with('roles')->whereLevel('admin')
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
                $query->where('email', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->paginate($this->perPage);

        if ($this->user_id) {
            $user = User::find($this->user_id);
            $roles = $user->roles->pluck('id');
            $roles = Role::whereNotIn('id', $roles)->orderBy('name', 'asc')->get();
        } else {
            $roles = Role::orderBy('name', 'asc')->get();
        }
        return view('livewire.admin.akun.pegawai', compact('users', 'roles'));
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

    public function clear()
    {
        $this->user_id = '';
        $this->selectedRoles = [];

    }

    public function getUserId($id)
    {
        $this->user_id = $id;
    }

    public function addRoleToUser()
    {

        $user = User::findOrFail($this->user_id);
        $user->assignRole($this->selectedRoles);

        $this->clear();
        $this->dispatch('close-modal');
        $this->alert('success', 'Role Berhasil DiTambahkan');

    }

    public function revokeRole($user_id, $role_id)
    {

        $user = User::findOrFail($user_id);
        $role = Role::findOrFail($role_id);
        $user->removeRole($role->name);

        $this->alert('success', 'Role Berhasil di hapus dari pengguna');

    }

    public function changeActive($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->is_aktif = !$user->is_aktif;
            $user->save();

        } catch (\Throwable $th) {

            Log::error('gagal Menonaktifakan user' . $th->getMessage());
            //throw $th;
        }
    }

}
