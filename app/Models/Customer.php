<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Customer extends Model
{
    protected $table = 'cliente';

    protected $fillable = [
        'nombres',
        'apellidos',
        'ci',
        'email',
        'telefono',
        'direccion',
        'fecha_nacimiento',
    ];

    public function getFullName() {
        return $this->nombres + ' ' + $this->apellidos;
    }

    function getTraditionalDate() {
        setlocale(LC_TIME, 'Spanish'); // Establece el locale en español
        return Carbon::parse($this->fecha_nacimiento)->formatLocalized('%e de %B de %Y');
    }

    use HasFactory;

}
