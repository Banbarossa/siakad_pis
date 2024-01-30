<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PrestasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $studentId = 1;

        $prestasiData = [
            [
                'student_id' => $studentId,
                'tanggal' => '2023-01-05',
                'tingkat' => 'Sekolah',
                'peringkat' => 'Juara 1',
                'deskripsi' => 'Prestasi dalam lomba karya tulis tingkat sekolah.',
            ],
            [
                'student_id' => $studentId,
                'tanggal' => '2023-03-20',
                'tingkat' => 'Kota',
                'peringkat' => 'Juara 2',
                'deskripsi' => 'Prestasi dalam lomba debat tingkat kota.',
            ],
            [
                'student_id' => $studentId,
                'tanggal' => '2023-05-10',
                'tingkat' => 'Provinsi',
                'peringkat' => 'Juara 3',
                'deskripsi' => 'Prestasi dalam lomba renang tingkat provinsi.',
            ],
            [
                'student_id' => $studentId,
                'tanggal' => '2023-07-15',
                'tingkat' => 'Nasional',
                'peringkat' => 'Juara Harapan',
                'deskripsi' => 'Prestasi dalam olimpiade matematika tingkat nasional.',
            ],
            [
                'student_id' => $studentId,
                'tanggal' => '2023-09-28',
                'tingkat' => 'Internasional',
                'peringkat' => 'Finalis',
                'deskripsi' => 'Prestasi sebagai finalis dalam kompetisi robotik internasional.',
            ],
        ];

        foreach ($prestasiData as $prestasi) {
            \App\Models\Prestasi::create($prestasi);
        }

    }
}
