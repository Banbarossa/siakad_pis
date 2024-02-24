<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::create([
            'name' => 'Khairuddin',
            'email' => 'banbarossa@pis.sch.id',
            'level' => 'admin',
            'is_aktif' => true,
            'password' => Hash::make('PIS@Admin30'),
        ]);
        User::create([
            'name' => 'Fuad yusuf',
            'email' => 'fuad@pis.sch.id',
            'level' => 'admin',
            'is_aktif' => true,
            'password' => Hash::make('PIS@Admin30'),
        ]);
        User::create([
            'name' => 'Haris Maulana',
            'email' => 'haris@pis.sch.id',
            'level' => 'admin',
            'is_aktif' => true,
            'password' => Hash::make('PIS@Admin30'),
        ]);
        $this->call(SpatieSeeder::class);
        $this->call(TypepegawaiSeeder::class);

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // \App\Models\Student::factory(30)->create();

        $this->call(IndoRegionSeeder::class);
        // $this->call(PrestasiSeeder::class);
        // $this->call(ScholarshipSeeder::class);
        // $this->call(RiwayatPendidikanSeeder::class);
        // $this->call(PengajuanSuratSeeder::class);
        $this->call(LembagaSeeder::class);
        $this->call(DaftarPekerjaanSeeder::class);
        $this->call(TahunAjaranSeeder::class);
        $this->call(SemesterSeeder::class);
    }
}
