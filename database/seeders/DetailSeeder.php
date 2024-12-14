<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalesDetailSeeder extends Seeder
{
  public function run(): void
  {
    DB::table('detalle')->insert([
      ['id_venta' => 1, 'id_producto' => 1, 'cantidad' => 1, 'precio' => 19.99],
      ['id_venta' => 1, 'id_producto' => 2, 'cantidad' => 1, 'precio' => 9.99],
      ['id_venta' => 2, 'id_producto' => 1, 'cantidad' => 1, 'precio' => 19.99],
    ]);
  }
}
