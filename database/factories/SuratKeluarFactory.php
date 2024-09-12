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
        $divisi = ['SEKJEN', 'PENDIS', 'SEKSI PENY. HAJI & UMRAH', 'SEKSI BIMAS ISLAM', 'PENY. SYARIAH', 'PENY. KRISTE', 'KATOLIK', 'HINDU', 'UMUM'];

        return [
            'nomor_surat' => strtoupper($this->faker->bothify('###/???/##/2024')),
            'tanggal_surat' => $this->faker->date(),
            'tanggal_keluar' => $this->faker->date(),
            'pengirim' => $this->faker->randomElement($divisi),
            'kepada' => $this->faker->name(),
            'perihal' => $this->faker->sentence(),
        ];
    }
}
