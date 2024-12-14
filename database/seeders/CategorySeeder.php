<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
  public function run(): void
  {
    DB::table('categoria')->insert([
      ['nombre' => 'Cuidado de la piel', 'descripcion' => 'Productos para el cuidado de la piel'],
      ['nombre' => 'Maquillaje', 'descripcion' => 'Productos de maquillaje'],
      ['nombre' => 'Cuidado del cabello', 'descripcion' => 'Productos para el cuidado del cabello'],
    ]);
  }
}
