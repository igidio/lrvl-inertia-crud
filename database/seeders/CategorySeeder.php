<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
  public function run(): void
  {
    DB::table('categoria')->insert([
      ['nombre' => 'Cuidado de la piel', 'descripcion' => 'Productos para el cuidado de la piel', 'created_at' => now(), 'updated_at' => now()],
      ['nombre' => 'Maquillaje', 'descripcion' => 'Productos de maquillaje', 'created_at' => now(), 'updated_at' => now()],
      ['nombre' => 'Cuidado del cabello', 'descripcion' => 'Productos para el cuidado del cabello', 'created_at' => now(), 'updated_at' => now()],
      ['nombre' => 'Perfumes', 'descripcion' => 'Fragancias y perfumes', 'created_at' => now(), 'updated_at' => now()],
      ['nombre' => 'Cuidado de las uñas', 'descripcion' => 'Productos para el cuidado de las uñas', 'created_at' => now(), 'updated_at' => now()],
      ['nombre' => 'Cuidado corporal', 'descripcion' => 'Productos para el cuidado del cuerpo', 'created_at' => now(), 'updated_at' => now()],
      ['nombre' => 'Cuidado facial', 'descripcion' => 'Productos para el cuidado del rostro', 'created_at' => now(), 'updated_at' => now()],
      ['nombre' => 'Cuidado dental', 'descripcion' => 'Productos para el cuidado dental', 'created_at' => now(), 'updated_at' => now()],
      ['nombre' => 'Protección solar', 'descripcion' => 'Productos de protección solar', 'created_at' => now(), 'updated_at' => now()],
      ['nombre' => 'Aromaterapia', 'descripcion' => 'Productos de aromaterapia', 'created_at' => now(), 'updated_at' => now()],
      ['nombre' => 'Accesorios de belleza', 'descripcion' => 'Accesorios para la belleza', 'created_at' => now(), 'updated_at' => now()],
      ['nombre' => 'Cuidado de los pies', 'descripcion' => 'Productos para el cuidado de los pies', 'created_at' => now(), 'updated_at' => now()],
      ['nombre' => 'Cuidado de los ojos', 'descripcion' => 'Productos para el cuidado de los ojos', 'created_at' => now(), 'updated_at' => now()],
      ['nombre' => 'Cuidado de labios', 'descripcion' => 'Productos para el cuidado de los labios', 'created_at' => now(), 'updated_at' => now()],
      ['nombre' => 'Cuidado masculino', 'descripcion' => 'Productos de belleza para hombres', 'created_at' => now(), 'updated_at' => now()],
      ['nombre' => 'Cuidado infantil', 'descripcion' => 'Productos de belleza para niños', 'created_at' => now(), 'updated_at' => now()],
      ['nombre' => 'Otros', 'descripcion' => 'Otros productos, que pueden o no estar categorizados', 'created_at' => now(), 'updated_at' => now()],
    ]);
  }
}
