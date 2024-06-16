<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::create([
            'nombre' => 'Corte de cabello',
            'descripcion' => 'Corte y estilo personalizado',
            'duracion' => 30,
            'precio' => 25.00
        ]);
        Service::create([
            'nombre' => 'Tinte completo',
            'descripcion' => 'Coloración completa del cabello',
            'duracion' => 120,
            'precio' => 60.00
        ]);
        Service::create([
            'nombre' => 'Manicura',
            'descripcion' => 'Manicura clásica con esmaltado',
            'duracion' => 45,
            'precio' => 15.00
        ]);
        Service::create([
            'nombre' => 'Pedicura',
            'descripcion' => 'Pedicura completa con masaje',
            'duracion' => 60,
            'precio' => 20.00
        ]);
        Service::create([
            'nombre' => 'Depilación de cejas',
            'descripcion' => 'Depilación y modelado de cejas',
            'duracion' => 20,
            'precio' => 10.00
        ]);
        Service::create([
            'nombre' => 'Masaje relajante',
            'descripcion' => 'Masaje corporal completo para aliviar tensiones',
            'duracion' => 90,
            'precio' => 50.00
        ]);
        Service::create([
            'nombre' => 'Limpieza facial',
            'descripcion' => 'Limpieza profunda con extracción de impurezas',
            'duracion' => 50,
            'precio' => 30.00
        ]);
        Service::create([
            'nombre' => 'Tratamiento antiacné',
            'descripcion' => 'Tratamiento especializado para piel con acné',
            'duracion' => 60,
            'precio' => 40.00
        ]);
        Service::create([
            'nombre' => 'Hidratación capilar',
            'descripcion' => 'Tratamiento hidratante para el cabello',
            'duracion' => 60,
            'precio' => 35.00
        ]);
        Service::create([
            'nombre' => 'Maquillaje profesional',
            'descripcion' => 'Maquillaje para eventos especiales',
            'duracion' => 70,
            'precio' => 45.00
        ]);
        Service::create([
            'nombre' => 'Bronceado spray',
            'descripcion' => 'Bronceado uniforme y sin sol',
            'duracion' => 20,
            'precio' => 25.00
        ]);
        Service::create([
            'nombre' => 'Exfoliación corporal',
            'descripcion' => 'Exfoliación para renovar la piel',
            'duracion' => 40,
            'precio' => 30.00
        ]);
        Service::create([
            'nombre' => 'Envoltura corporal',
            'descripcion' => 'Tratamiento desintoxicante con envoltura de algas',
            'duracion' => 60,
            'precio' => 40.00
        ], );
        Service::create([
            'nombre' => 'Microdermoabrasión',
            'descripcion' => 'Renovación de la piel con microcristales',
            'duracion' => 45,
            'precio' => 50.00
        ]);
        Service::create([
            'nombre' => 'Peeling químico',
            'descripcion' => 'Peeling para mejorar la textura de la piel',
            'duracion' => 30,
            'precio' => 55.00
        ]);
        Service::create([
            'nombre' => "Extensiones de pestañas",
            "descripcion" => "Aplicación de extensiones para realzar la mirada",
            "duracion" => 75,
            "precio" => 70.00
        ]);
        Service::create([
            "nombre" => "Botox capilar",
            "descripcion" => "Tratamiento rejuvenecedor para el cabello",
            "duracion" => 90,
            "precio" => 80.00,
        ]);
    }
}
