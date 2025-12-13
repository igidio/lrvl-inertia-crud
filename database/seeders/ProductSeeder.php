<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
  public function run(): void
  {
    DB::table('producto')->insert([
      [
        'nombre' => 'Crema hidratante',
        'descripcion' => 'Crema para hidratar la piel',
        'precio' => 19.99,
        'id_categoria' => 1,
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'nombre' => 'Shampoo',
        'descripcion' => 'Shampoo para el cabello',
        'precio' => 9.99,
        'id_categoria' => 3,
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'nombre' => 'Acondicionador',
        'descripcion' => 'Acondicionador para el cabello',
        'precio' => 8.99,
        'id_categoria' => 3,
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'nombre' => 'Gel de baño',
        'descripcion' => 'Gel para el baño',
        'precio' => 7.99,
        'id_categoria' => 6,
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'nombre' => 'Loción corporal',
        'descripcion' => 'Loción para el cuerpo',
        'precio' => 12.99,
        'id_categoria' => 6,
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'nombre' => 'Perfume',
        'descripcion' => 'Fragancia y perfume',
        'precio' => 29.99,
        'id_categoria' => 4,
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'nombre' => 'Esmalte de uñas',
        'descripcion' => 'Esmalte para las uñas',
        'precio' => 4.99,
        'id_categoria' => 5,
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'nombre' => 'Mascarilla facial',
        'descripcion' => 'Mascarilla para el rostro',
        'precio' => 5.99,
        'id_categoria' => 7,
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'nombre' => 'Protector solar',
        'descripcion' => 'Protector solar para la piel',
        'precio' => 14.99,
        'id_categoria' => 9,
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'nombre' => 'Aceite esencial',
        'descripcion' => 'Aceite esencial para aromaterapia',
        'precio' => 9.99,
        'id_categoria' => 10,
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'nombre' => 'Cepillo de dientes',
        'descripcion' => 'Cepillo para el cuidado dental',
        'precio' => 3.99,
        'id_categoria' => 8,
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'nombre' => 'Crema de manos',
        'descripcion' => 'Crema para hidratar las manos',
        'precio' => 6.99,
        'id_categoria' => 1,
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'nombre' => 'Serum facial',
        'descripcion' => 'Serum para el cuidado del rostro',
        'precio' => 24.99,
        'id_categoria' => 7,
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'nombre' => 'Exfoliante corporal',
        'descripcion' => 'Exfoliante para el cuerpo',
        'precio' => 11.99,
        'id_categoria' => 6,
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'nombre' => 'Tónico facial',
        'descripcion' => 'Tónico para el rostro',
        'precio' => 13.99,
        'id_categoria' => 7,
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'nombre' => 'Bálsamo labial',
        'descripcion' => 'Bálsamo para los labios',
        'precio' => 2.99,
        'id_categoria' => 1,
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'nombre' => 'Crema antiarrugas',
        'descripcion' => 'Crema para reducir arrugas',
        'precio' => 21.99,
        'id_categoria' => 1,
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'nombre' => 'Desmaquillante',
        'descripcion' => 'Producto para remover maquillaje',
        'precio' => 7.99,
        'id_categoria' => 2,
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'nombre' => 'Mascarilla capilar',
        'descripcion' => 'Mascarilla para el cabello',
        'precio' => 15.99,
        'id_categoria' => 3,
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'nombre' => 'Crema para pies',
        'descripcion' => 'Crema para el cuidado de los pies',
        'precio' => 8.99,
        'id_categoria' => 12,
        'created_at' => now(),
        'updated_at' => now()
      ],
    ]);
  }
}
