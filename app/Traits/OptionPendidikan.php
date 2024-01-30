<?php
namespace App\Traits;

trait OptionPendidikan
{
    public function pendidikan()
    {
        return [
            'Tidak Sekolah',
            'Sekolah Dasar',
            'Sekolah Menengah Pertama',
            'Sekolah Menengah Atas',
            'Diploma',
            'Sarjana (S1)',
            'Magister (S2)',
            'Doktor (S3)',
        ];

    }
}
