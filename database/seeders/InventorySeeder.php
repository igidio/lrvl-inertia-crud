<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InventorySeeder extends Seeder
{
  public function run(): void
  {
    DB::table('inventario')->insert([
      ['id_producto' => 1, 'cantidad' => 100, 'created_at' => now(), 'updated_at' => now()],
      ['id_producto' => 2, 'cantidad' => 200, 'created_at' => now(), 'updated_at' => now()],
      ['id_producto' => 3, 'cantidad' => 150, 'created_at' => now(), 'updated_at' => now()],
      ['id_producto' => 4, 'cantidad' => 120, 'created_at' => now(), 'updated_at' => now()],
      ['id_producto' => 5, 'cantidad' => 180, 'created_at' => now(), 'updated_at' => now()],
      ['id_producto' => 6, 'cantidad' => 90, 'created_at' => now(), 'updated_at' => now()],
      ['id_producto' => 7, 'cantidad' => 300, 'created_at' => now(), 'updated_at' => now()],
      ['id_producto' => 8, 'cantidad' => 250, 'created_at' => now(), 'updated_at' => now()],
      ['id_producto' => 9, 'cantidad' => 110, 'created_at' => now(), 'updated_at' => now()],
      ['id_producto' => 10, 'cantidad' => 130, 'created_at' => now(), 'updated_at' => now()],
      ['id_producto' => 11, 'cantidad' => 400, 'created_at' => now(), 'updated_at' => now()],
      ['id_producto' => 12, 'cantidad' => 220, 'created_at' => now(), 'updated_at' => now()],
      ['id_producto' => 13, 'cantidad' => 140, 'created_at' => now(), 'updated_at' => now()],
      ['id_producto' => 14, 'cantidad' => 160, 'created_at' => now(), 'updated_at' => now()],
      ['id_producto' => 15, 'cantidad' => 270, 'created_at' => now(), 'updated_at' => now()],
      ['id_producto' => 16, 'cantidad' => 310, 'created_at' => now(), 'updated_at' => now()],
      ['id_producto' => 17, 'cantidad' => 190, 'created_at' => now(), 'updated_at' => now()],
      ['id_producto' => 18, 'cantidad' => 210, 'created_at' => now(), 'updated_at' => now()],
      ['id_producto' => 19, 'cantidad' => 230, 'created_at' => now(), 'updated_at' => now()],
      ['id_producto' => 20, 'cantidad' => 170, 'created_at' => now(), 'updated_at' => now()],
    ]);
  }
}
