<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
  public function run(): void
  {
    DB::table('proovedor')->insert([
      ['nombre' => 'Proveedor 1', 'contacto' => 'Contacto 1', 'telefono' => '123456789', 'email' => 'proveedor1@example.com'],
      ['nombre' => 'Proveedor 2', 'contacto' => 'Contacto 2', 'telefono' => '987654321', 'email' => 'proveedor2@example.com'],
    ]);
  }
}
