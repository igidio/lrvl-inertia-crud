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

  public function client(): BelongsTo
  {
    return $this->belongsTo(Client::class, 'id_cliente');
  }

  public function salesDetails(): HasMany
  {
    return $this->hasMany(SalesDetail::class, 'id_venta');
  }
}
