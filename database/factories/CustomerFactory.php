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

        #$this->faker = \Faker\Factory::create('es_AR');
        return [
            'nombres' => $this->faker->firstName,
            'apellidos' => $this->faker->lastName,
            'ci' => $this->faker->unique()->numberBetween(10000000, 19999999),
            'email' => $this->faker->unique()->safeEmail,
            'telefono' => $this->faker->unique()->numberBetween(70000000, 79999999),
            'direccion' => $this->faker->address,
            'fecha_nacimiento' => $this->faker->date(),
            'es_activo' => 1,
        ];
    }

}
