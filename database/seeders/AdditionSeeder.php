<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdditionSeeder extends Seeder
{
  public function run(): void
  {
    DB::table('adicion')->insert([
      ['proveedor_id' => 1, 'inventario_id' => 1, 'cantidad' => 50, 'created_at' => now(), 'updated_at' => now()],
      ['proveedor_id' => 1, 'inventario_id' => 2, 'cantidad' => 100, 'created_at' => now(), 'updated_at' => now()],
      ['proveedor_id' => 2, 'inventario_id' => 3, 'cantidad' => 75, 'created_at' => now(), 'updated_at' => now()],
      ['proveedor_id' => 2, 'inventario_id' => 4, 'cantidad' => 60, 'created_at' => now(), 'updated_at' => now()],
      ['proveedor_id' => 1, 'inventario_id' => 5, 'cantidad' => 90, 'created_at' => now(), 'updated_at' => now()],
      ['proveedor_id' => 1, 'inventario_id' => 6, 'cantidad' => 45, 'created_at' => now(), 'updated_at' => now()],
      ['proveedor_id' => 2, 'inventario_id' => 7, 'cantidad' => 150, 'created_at' => now(), 'updated_at' => now()],
      ['proveedor_id' => 2, 'inventario_id' => 8, 'cantidad' => 125, 'created_at' => now(), 'updated_at' => now()],
      ['proveedor_id' => 1, 'inventario_id' => 9, 'cantidad' => 55, 'created_at' => now(), 'updated_at' => now()],
      ['proveedor_id' => 1, 'inventario_id' => 10, 'cantidad' => 65, 'created_at' => now(), 'updated_at' => now()],
    ]);
  }
}
