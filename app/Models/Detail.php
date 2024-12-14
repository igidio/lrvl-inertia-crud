<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;

class Detail extends Model
{
  protected $table = 'detalle';

  protected $fillable = [
    'id_venta',
    'id_producto',
    'cantidad',
    'precio',
  ];

  use HasFactory;

  public function sale(): BelongsTo
  {
    return $this->belongsTo(Sale::class, 'id_venta');
  }

  public function product(): BelongsTo
  {
    return $this->belongsTo(Product::class, 'id_producto');
  }
}
