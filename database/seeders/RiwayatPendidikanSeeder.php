<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RiwayatPendidikanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            DB::table('riwayat_pendidikans')->insert([
                'student_id' => 1,
                'nama_sekolah' => 'Sekolah ' . ($i + 1),
                'jenjang' => 'Jenjang ' . ($i + 1),
                'npsn' => rand(10000000, 99999999),
                'is_latest' => $i === 9,
                'alamat' => 'Alamat Sekolah ' . ($i + 1),
            ]);
        }
    }
}
