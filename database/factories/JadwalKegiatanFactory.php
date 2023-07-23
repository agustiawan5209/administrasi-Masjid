<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JadwalKegiatan>
 */
class JadwalKegiatanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tanggal'=> $this->faker->dateTimeBetween('-1 week', '+1 week'),
            'waktu'=> $this->faker->time(),
            'kegiatan'=> $this->faker->realText(20),
            'tempat'=> $this->faker->address(),
            'ket'=> $this->faker->paragraph(),
            'penanggung_jawab'=> $this->faker->name(),
        ];
    }
}
