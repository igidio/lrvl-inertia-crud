<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
  public function run(): void
  {
    DB::table('categoria')->insert([
      ['nombre' => 'Cuidado de la piel', 'descripcion' => 'Productos para el cuidado de la piel','created_at' => now(), 'updated_at' => now()],
      ['nombre' => 'Maquillaje', 'descripcion' => 'Productos de maquillaje','created_at' => now(), 'updated_at' => now()],
      ['nombre' => 'Cuidado del cabello', 'descripcion' => 'Productos para el cuidado del cabello','created_at' => now(), 'updated_at' => now()],
    ]);
  }
}
