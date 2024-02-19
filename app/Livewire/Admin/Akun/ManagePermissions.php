<?php

namespace App\Livewire\Admin\Akun;

use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;

class ManagePermissions extends Component
{
    use LivewireAlert, WithPagination;

    public $sortColumn = 'name', $sortDirection = 'asc', $perPage = 15, $search;

    public $permission_id, $permission_name;
    public function render()
    {

        $permissions = Permission::orderBy($this->sortColumn, $this->sortDirection)
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->paginate($this->perPage);

        return view('livewire.admin.akun.manage-permissions', compact('permissions'));
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
            'permission_name' => 'required|min:3|unique:permissions,name',
        ], [
            'permission_name.required' => 'Nama permission wajib di isi',
            'permission_name.min' => 'Nama minimal 3 karakter',
            'permission_name.unique' => 'Nama permission ini sudah digunakan',
        ]);
        Permission::create([
            'name' => $this->permission_name,
        ]);
        $this->clear();
        $this->dispatch('close-modal');
        $this->alert('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $permission = Permission::find($id);
        $this->permission_id = $permission->id;
        $this->permission_name = $permission->name;
    }

    public function perbaharuiData()
    {
        $this->validate([
            'permission_name' => ['required', 'min:3', Rule::unique(Permission::class, 'name')->ignore($this->permission_id)],
        ], [
            'permission_name.required' => 'Nama Permission wajib di isi',
            'permission_name.min' => 'Nama minimal 3 karakter',
            'permission_name.unique' => 'Nama Permission ini sudah digunakan',
        ]);
        $permission = Permission::find($this->permission_id);
        $permission->name = $this->permission_name;
        $permission->save();

        $this->clear();
        $this->dispatch('close-modal');
        $this->alert('success', 'Data Berhasil diperbaharui');
    }

    public function clear()
    {
        $this->permission_id = '';
        $this->permission_name = '';

    }
}
