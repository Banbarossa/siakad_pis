<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PelanggaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Pelanggaran::factory(10)->create();
    }
}
