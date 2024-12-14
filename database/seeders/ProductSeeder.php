<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
  public function run(): void
  {
    DB::table('producto')->insert([
      ['nombre' => 'Crema hidratante', 'descripcion' => 'Crema para hidratar la piel', 'precio' => 19.99, 'id_categoria' => 1, 'id_proveedor' => 1],
      ['nombre' => 'Shampoo', 'descripcion' => 'Shampoo para el cabello', 'precio' => 9.99, 'id_categoria' => 3, 'id_proveedor' => 2],
    ]);
  }
}
