<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SpatieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['Super Admin', 'Admin', 'Pengasuhan', "Cetak Surat"];

        $permissions = ['Kelola Santri', 'Kelola Pegawai', 'Kelola Master Data', 'Kelola Data Kepengasuhan', 'Kelola Akun'];

        foreach ($roles as $role) {
            Role::create([
                'name' => $role,
            ]);
        }
        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
            ]);
        }

        $khairuddin = User::where('email', 'banbarossa@pis.sch.id')->first();
        if ($khairuddin) {
            $khairuddin->assignRole('Super Admin');
        }

    }

}
