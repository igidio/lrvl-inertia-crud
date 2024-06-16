<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'servicio';

    protected $fillable = [
        'nombre',
        'descripcion',
        'duracion',
        'precio',
    ];
    use HasFactory;
}
