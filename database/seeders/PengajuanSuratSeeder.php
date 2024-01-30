<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PengajuanSuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        for ($i = 0; $i < 10; $i++) {
            DB::table('pengajuan_surats')->insert([
                'student_id' => 1,
                'kode_surat' => Str::uuid(),
                'nomor_surat' => 'Nomor Surat ' . ($i + 1),
                'jenis_surat' => 'Jenis Surat ' . ($i + 1),
                'tanggal_pengajuan' => Carbon::now()->subDays($i),
                'keperluan' => 'Keperluan ' . ($i + 1),
                'diajukan_oleh' => 2,
                'disetujui_oleh' => 3,
                'tanggal_disetujui' => Carbon::now()->subDays($i - 5)->format('Y-m-d H:i:s'), // Ubah sesuai kebutuhan
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
