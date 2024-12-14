<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InventorySeeder extends Seeder
{
  public function run(): void
  {
    DB::table('inventario')->insert([
      ['id_producto' => 1, 'cantidad' => 100],
      ['id_producto' => 2, 'cantidad' => 200],
    ]);
  }
}