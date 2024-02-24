<?php

namespace Database\Seeders;

use App\Models\Typepegawai;
use Illuminate\Database\Seeder;

class TypepegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'primary_type' => 'Guru',
                'detail_type' => 'Guru Tetap',
            ],
            [
                'primary_type' => 'Guru',
                'detail_type' => 'Guru Tidak Tetap',
            ],
            [
                'primary_type' => 'Pegawai',
                'detail_type' => 'Pegawai Tetap',
            ],
            [
                'primary_type' => 'Pegawai',
                'detail_type' => 'Pegawai Tidak Tetap',
            ],
            [
                'primary_type' => 'Staff',
                'detail_type' => 'Staff Tetap',
            ],
            [
                'primary_type' => 'Staff',
                'detail_type' => 'Staff Tidak Tetap',
            ],
        ];

        foreach ($data as $item) {
            Typepegawai::create([
                'primary_type' => $item['primary_type'],
                'detail_type' => $item['detail_type'],
            ]);
        }

    }
}
