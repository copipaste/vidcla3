<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Almacen>
 */
class AlmacenFactory extends Factory
{
  
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->unique()->word,
            'ubicacion' => $this->faker->address,
            'capacidad' => $this->faker->randomNumber(3),
        ];
    }
}
