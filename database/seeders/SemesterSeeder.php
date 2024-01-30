<?php

namespace Database\Seeders;

use App\Models\Semester;
use Illuminate\Database\Seeder;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Semester::create([
            'semester' => 'Ganjil',
            'start_date' => date('Y-m-d', strtotime('2023-7-31')),
            'end_date' => date('Y-m-d', strtotime('2023-12-23')),
            'tahun_ajaran_id' => 1,
            'status' => 1,
        ]);
    }
}
