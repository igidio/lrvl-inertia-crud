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
            'name' => 'Claudia',
            'email' => 'claudia@mail.com',
            'password' => 'PASSWORD',
            'id_rol' => '1'
        ]);
        $this->call(CategorySeeder::class);
        $this->call(SupplierSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(SaleSeeder::class);
        $this->call(DetailSeeder::class);
        $this->call(InventorySeeder::class);
    }
}
