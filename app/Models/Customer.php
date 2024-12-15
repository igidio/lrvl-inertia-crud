<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

  use HasFactory;

  public function appointments(): HasMany
  {
    return $this->hasMany(Appointment::class, 'id_cliente');
  }
}
