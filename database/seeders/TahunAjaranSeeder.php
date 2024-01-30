<?php

namespace Database\Seeders;

use App\Models\TahunAjaran;
use Illuminate\Database\Seeder;

class TahunAjaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        TahunAjaran::create([
            'tahun' => '2023/2024',
            'start_date' => date('Y-m-d', strtotime('2023-7-31')),
            'end_date' => date('Y-m-d', strtotime('2024-07-30')),
            'last_year' => 2024,
            'status' => 1,
        ]);
    }
}
