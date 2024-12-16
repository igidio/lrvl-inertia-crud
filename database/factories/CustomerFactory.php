<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */

class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

  public function definition(): array
  {
    $this->faker = \Faker\Factory::create('es_VE');

    $firstName = $this->faker->firstName;
    $lastName = $this->faker->lastName;
    $number = rand(1, 100);

    return [
      'nombres' => $firstName,
      'apellidos' => $lastName,
      'ci' => $this->faker->unique()->numberBetween(10000000, 19999999),
      'email' => strtolower($firstName) . '.' . strtolower($lastName) . $number . '@example.com',
      'telefono' => $this->faker->unique()->numberBetween(70000000, 79999999),
      'direccion' => $this->faker->address,
      'fecha_nacimiento' => $this->faker->dateTimeBetween('-60 year', '-18 year'),
      'es_activo' => 1,
    ];
  }

}
