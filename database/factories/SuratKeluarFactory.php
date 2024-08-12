<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SuratKeluar>
 */
class SuratKeluarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nomor_surat' => strtoupper($this->faker->bothify('###/???/##/2024')),
            'tanggal_keluar' => $this->faker->date(),
            'isi_ringkasan' => $this->faker->sentence(),
            'keterangan' => $this->faker->text(50),
            'lokasi_file' => $this->faker->filePath(), // Simulasi path file
            'alamat' => $this->faker->address(),
        ];
    }
}
