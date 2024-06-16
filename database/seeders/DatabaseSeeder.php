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
        User::factory()->create([
            'name' => 'Juan David',
            'email' => 'juanda@mail.com',
            'password' => 'JUANDAV',
            'id_rol' => '1'
        ]);
    }
}
