<?php

namespace App\Livewire\Admin\Akun;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermission extends Component
{
    use LivewireAlert;
    public Role $role;

    public $selectedPermission = [];
    public $permit = [];

    public function mount($id)
    {

        $role = Role::with('permissions')->find($id);

        $this->role = $role;
        $this->permit = $role->permissions->pluck('id')->toArray();

    }

    #[Title('Role Permission')]
    public function render()
    {
        $permissions = Permission::whereNotIn('id', $this->permit)->get();
        return view('livewire.admin.akun.role-permission', compact('permissions'));
    }

    public function addPermissionToRole()
    {
        $role = $this->role;
        foreach ($this->selectedPermission as $permission) {
            $permis = Permission::findOrFail($permission);
            $role->givePermissionTo($permis);
        }
        $this->alert('success', 'Permission berhasil di assign ke role');

    }

    public function removePermission($id)
    {
        $permission = Permission::findOrFail($id);
        $this->role->revokePermissionTo($permission);

    }
}
