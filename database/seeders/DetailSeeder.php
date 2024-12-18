<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailSeeder extends Seeder
{
  public function run(): void
  {
    DB::table('detalle')->insert([
      ['id_venta' => 1, 'id_producto' => 1, 'cantidad' => 1, 'precio' => 19.99, 'created_at' => now(), 'updated_at' => now()],
      ['id_venta' => 1, 'id_producto' => 2, 'cantidad' => 1, 'precio' => 9.99, 'created_at' => now(), 'updated_at' => now()],
      ['id_venta' => 2, 'id_producto' => 1, 'cantidad' => 1, 'precio' => 19.99, 'created_at' => now(), 'updated_at' => now()],
      ['id_venta' => 2, 'id_producto' => 3, 'cantidad' => 2, 'precio' => 8.99, 'created_at' => now(), 'updated_at' => now()],
      ['id_venta' => 3, 'id_producto' => 4, 'cantidad' => 1, 'precio' => 7.99, 'created_at' => now(), 'updated_at' => now()],
      ['id_venta' => 3, 'id_producto' => 5, 'cantidad' => 1, 'precio' => 12.99, 'created_at' => now(), 'updated_at' => now()],
      ['id_venta' => 4, 'id_producto' => 6, 'cantidad' => 1, 'precio' => 29.99, 'created_at' => now(), 'updated_at' => now()],
      ['id_venta' => 4, 'id_producto' => 7, 'cantidad' => 3, 'precio' => 4.99, 'created_at' => now(), 'updated_at' => now()],
      ['id_venta' => 5, 'id_producto' => 8, 'cantidad' => 2, 'precio' => 5.99, 'created_at' => now(), 'updated_at' => now()],
      ['id_venta' => 5, 'id_producto' => 9, 'cantidad' => 1, 'precio' => 14.99, 'created_at' => now(), 'updated_at' => now()],
    ]);
  }
}
