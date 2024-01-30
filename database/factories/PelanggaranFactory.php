<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pelanggaran>
 */
class PelanggaranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id' => 1,
            'tanggal' => $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
            'jam' => $this->faker->time(),
            'level_pelanggaran' => $this->faker->randomElement(['Ringan', 'Sedang', 'Berat']),
            'deskripsi' => $this->faker->sentence,
            'penanganan' => $this->faker->paragraph,
            'point' => $this->faker->optional()->numberBetween(1, 10),
            'is_show' => $this->faker->boolean(80),
        ];
    }
}
