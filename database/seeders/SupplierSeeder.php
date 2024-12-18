<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
  public function run(): void
  {
//    DB::table('proveedor')->insert([
//      ['nombre' => 'Proveedor 1', 'telefono' => '123456789', 'email' => 'proveedor1@example.com','created_at' => now(), 'updated_at' => now()],
//      ['nombre' => 'Proveedor 2', 'telefono' => '987654321', 'email' => 'proveedor2@example.com','created_at' => now(), 'updated_at' => now()],
//    ]);
    Supplier::factory()->count(7)->create();
  }
}
