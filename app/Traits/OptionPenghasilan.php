<?php
namespace App\Traits;

use App\Models\DaftarPekerjaan as ModelsDaftarPekerjaan;

trait OptionPenghasilan
{
    public function penghasilan()
    {
        return [
            'Kurang dari Rp 1.000.000',
            'Rp 1.000.000 - Rp 3.000.000',
            'Rp 3.000.000 - Rp 5.000.000',
            'Rp 5.000.000 - Rp 10.000.000',
            'Lebih dari Rp 10.000.000',
        ];

    }
}
