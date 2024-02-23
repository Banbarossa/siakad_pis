<?php

namespace Database\Seeders;

use App\Models\Lembaga;
use Illuminate\Database\Seeder;

class LembagaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Lembaga::create([
            'nama_lembaga' => "Pesantren Imam Syafi'i",
            'nama_pimpinan' => 'T.TOMMY YANUAR SATRIA, S.Pd.I, M.Ag',
            'nip_pimpinan' => '',
            'village_id' => 1108100024,
        ]);
    }
}
