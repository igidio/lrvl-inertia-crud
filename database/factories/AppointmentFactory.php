<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_cliente' => $this->faker->numberBetween(1, 20),
            'id_servicio' => $this->faker->numberBetween(1, 15),
            'fecha' => $this->faker->dateTimeBetween('-30 days', '+10 days'),
            'hora' => $this->faker->dateTimeBetween('today 9:00 AM', 'today 6:00 PM')->format('H:i'),
            'notas' => $this->faker->paragraph,
        ];
    }
}
