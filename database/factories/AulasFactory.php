<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Aulas>
 */
class AulasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'codigo' => $this->faker->unique()->regexify('[A-Z]{1}[0-9]{3}'), // Ej: A105
            'tipo' => $this->faker->randomElement(['teoria', 'laboratorio', 'mixto']),
            'aforo' => $this->faker->numberBetween(10, 50),
            'estado' => 'activo',
        ];
    }
}
