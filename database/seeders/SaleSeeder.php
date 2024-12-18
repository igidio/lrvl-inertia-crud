<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SaleSeeder extends Seeder
{
  public function run(): void
  {
    DB::table('venta')->insert([
      ['id_cliente' => 1, 'fecha' => '2024-01-01', 'total' => 29.98, 'created_at' => now(), 'updated_at' => now()],
      ['id_cliente' => 2, 'fecha' => '2024-01-02', 'total' => 37.97, 'created_at' => now(), 'updated_at' => now()],
      ['id_cliente' => 3, 'fecha' => '2024-01-03', 'total' => 20.98, 'created_at' => now(), 'updated_at' => now()],
      ['id_cliente' => 4, 'fecha' => '2024-01-04', 'total' => 44.97, 'created_at' => now(), 'updated_at' => now()],
      ['id_cliente' => 5, 'fecha' => '2024-01-05', 'total' => 20.98, 'created_at' => now(), 'updated_at' => now()],
    ]);
  }
}
