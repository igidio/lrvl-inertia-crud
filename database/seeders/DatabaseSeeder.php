<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call(RolSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(AppointmentSeeder::class);
        User::factory()->create([
            'name' => 'Juan David',
            'email' => 'juandavid@mail.com',
            'password' => 'JUANDAVID',
            'id_rol' => '1'
        ]);
    }
}
