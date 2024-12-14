<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
  protected $table = 'proveedor';

  protected $fillable = [
    'nombre',
    'contacto',
    'telefono',
    'email',
  ];

  use HasFactory;

  public function products(): \Illuminate\Database\Eloquent\Relations\HasMany
  {
    return $this->hasMany(Product::class, 'id_proveedor');
  }
}
