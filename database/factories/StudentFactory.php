<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->name,
            'nisn' => $this->faker->numberBetween(1000000000, 9999999999),
            'nis_sekolah' => $this->faker->optional()->numerify('##########'),
            'nis_pesantren' => $this->faker->optional()->numerify('##########'),
            'nik' => $this->faker->numerify('################'),
            'jenis_kelamin' => $this->faker->randomElement(['L', 'P']),
            'tempat_lahir' => $this->faker->city,
            'tanggal_lahir' => $this->faker->date,
            'tahun_masuk' => $this->faker->date,
            'status_sosial' => $this->faker->optional()->word,
            'status_rumah' => $this->faker->optional()->word,
            'is_asrama' => $this->faker->boolean,
            'nama_wali' => $this->faker->optional()->name,
            'nomor_yatim' => $this->faker->optional()->numerify('################'),
            'nomor_wali' => $this->faker->optional()->phoneNumber,
            'no_kk' => $this->faker->optional()->numerify('################'),
            'hubungan_keluarga' => $this->faker->optional()->word,
            'anak_ke' => $this->faker->optional()->numberBetween(1, 10),
            'dari_jumlah_saudara' => $this->faker->optional()->numberBetween(1, 10),
            'jumlah_saudara_laki_laki' => $this->faker->optional()->numberBetween(1, 10),
            'jumlah_saudara_perempuan' => $this->faker->optional()->numberBetween(1, 10),
            'nomor_registrasi_akte_lahir' => $this->faker->optional()->numerify('################'),
            'hobi' => $this->faker->optional()->word,
            'cita_cita' => $this->faker->optional()->word,
            'tinggi_badan' => $this->faker->optional()->numberBetween(100, 200),
            'berat_badan' => $this->faker->optional()->numberBetween(30, 150),
            'golongan_darah' => $this->faker->optional()->randomElement(['A', 'B', 'AB', 'O']),
            'alamat' => $this->faker->optional()->address,
            'village_id' => null,
            'kode_pos' => $this->faker->optional()->numerify('#####'),
            'is_aktif' => $this->faker->boolean,

            'status_siswa' => $this->faker->randomElement(['aktif']),
        ];
    }
}
