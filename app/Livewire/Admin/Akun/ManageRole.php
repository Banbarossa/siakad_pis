<?php

namespace App\Livewire\Admin\Akun;

use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class ManageRole extends Component
{
    use LivewireAlert, WithPagination;
    public $sortColumn = 'name', $sortDirection = 'asc', $perPage = 15, $search;

    public $role_id, $role_name;

    public function render()
    {
        $roles = Role::orderBy($this->sortColumn, $this->sortDirection)
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->paginate($this->perPage);
        return view('livewire.admin.akun.manage-role', compact('roles'));
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

    public function store()
    {
        $this->validate([
            'role_name' => 'required|min:3|unique:roles,name',
        ], [
            'role_name.required' => 'Nama role wajib di isi',
            'role_name.min' => 'Nama minimal 3 karakter',
            'role_name.unique' => 'Nama Role ini sudah digunakan',
        ]);
        Role::create([
            'name' => $this->role_name,
        ]);
        $this->clear();
        $this->dispatch('close-modal');
        $this->alert('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $this->role_id = $role->id;
        $this->role_name = $role->name;
    }

    public function perbaharuiData()
    {
        $this->validate([
            'role_name' => ['required', 'min:3', Rule::unique(Role::class, 'name')->ignore($this->role_id)],
        ], [
            'role_name.required' => 'Nama role wajib di isi',
            'role_name.min' => 'Nama minimal 3 karakter',
            'role_name.unique' => 'Nama Role ini sudah digunakan',
        ]);
        $role = Role::find($this->role_id);
        $role->name = $this->role_name;
        $role->save();

        $this->clear();
        $this->dispatch('close-modal');
        $this->alert('success', 'Data Berhasil diperbaharui');
    }

    public function clear()
    {
        $this->role_id = '';
        $this->role_name = '';

    }
}
