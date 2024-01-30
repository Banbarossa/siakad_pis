<?php

namespace Database\Seeders;

use App\Models\DaftarPekerjaan;
use Illuminate\Database\Seeder;

class DaftarPekerjaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pekerjaan = [
            'Pelajar',
            'Mahasiswa',
            'Pegawai Swasta',
            'Pegawai Negeri',
            'Wiraswasta',
            'Pensiunan',
            'Lainnya',
        ];

        foreach ($pekerjaan as $key => $item) {
            DaftarPekerjaan::create([
                'no_urut' => $key + 1,
                'nama' => $item,
            ]);
        }
    }
}
