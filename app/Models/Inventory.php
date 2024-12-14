<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
  protected $table = 'inventario';

  protected $fillable = [
    'id_producto',
    'cantidad',
  ];

  use HasFactory;

  public function product()
  {
    return $this->belongsTo(Product::class, 'id_producto');
  }
}
