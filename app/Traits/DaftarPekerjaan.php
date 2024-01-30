<?php
namespace App\Traits;

use App\Models\DaftarPekerjaan as ModelsDaftarPekerjaan;

trait DaftarPekerjaan
{
    public function pekerjaan()
    {
        $pekerjaan = ModelsDaftarPekerjaan::orderBy('no_urut', 'asc')->pluck('nama');
        return $pekerjaan;
    }
}
