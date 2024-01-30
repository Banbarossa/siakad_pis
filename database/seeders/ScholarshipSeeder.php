<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScholarshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            DB::table('scholarships')->insert([
                'student_id' => 1,
                'tahun' => rand(2020, 2023),
                'bulan' => rand(1, 12),
                'tanggal_terima' => now()->subMonths(rand(1, 24))->subDays(rand(1, 30)),
                'sumber' => 'Sumber Beasiswa ' . ($i + 1),
                'jumlah' => rand(100000, 500000),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
