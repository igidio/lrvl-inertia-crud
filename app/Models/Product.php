<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Illuminate\Database\Eloquent\Relations\HasMany;
use \Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
  protected $table = 'producto';

  protected $fillable = [
    'nombre',
    'descripcion',
    'precio',
    'id_categoria',
  ];

  use HasFactory;

  public function category(): BelongsTo
  {
    return $this->belongsTo(Category::class, 'id_categoria');
  }

  public function supplier(): BelongsTo
  {
    return $this->belongsTo(Supplier::class, 'id_proveedor');
  }

  public function salesDetails(): HasMany
  {
    return $this->hasMany(SalesDetail::class, 'id_producto');
  }

  public function inventory(): HasOne
  {
    return $this->hasOne(Inventory::class, 'id_producto');
  }
}
