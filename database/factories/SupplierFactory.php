<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
      $this->faker = \Faker\Factory::create('es_VE');

      return [
        'nombre' => $this->faker->company,
        'telefono' => $this->faker->numberBetween(60000000, 79999999),
        'email' => $this->faker->unique()->safeEmail,
        'created_at' => now(),
        'updated_at' => now(),
      ];
    }
}
