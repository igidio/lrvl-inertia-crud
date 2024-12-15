<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
  protected $table = 'proveedor';

  protected $fillable = [
    'nombre',
    'telefono',
    'email',
  ];

  use HasFactory;

  public function products(): HasMany
  {
    return $this->hasMany(Product::class, 'id_proveedor');
  }
}