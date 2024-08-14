<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SuratMasuk>
 */
class SuratMasukFactory extends Factory
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
            'tanggal_surat' => $this->faker->date(),
            'tanggal_masuk' => $this->faker->date(),
            'pengirim' => $this->faker->company,
            'perihal' => $this->faker->sentence(),
        ];
    }
}
