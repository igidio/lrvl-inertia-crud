<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Illuminate\Database\Eloquent\Relations\HasMany;

class Sale extends Model
{
  protected $table = 'venta';

  protected $fillable = [
    'id_cliente',
    'fecha',
    'total',
  ];

  use HasFactory;

  public function customer(): BelongsTo
  {
    return $this->belongsTo(Customer::class, 'id_cliente');
  }

  public function details(): HasMany
  {
    return $this->hasMany(Detail::class, 'id_venta');
  }
}
