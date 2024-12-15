<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class addition extends Model
{
  use HasFactory;

  protected $table = 'adicion';

  protected $fillable = [
    'proveedor_id',
    'inventario_id',
    'cantidad',
  ];

  public function proveedor()
  {
    return $this->belongsTo(Supplier::class, 'proveedor_id');
  }

  public function inventario()
  {
    return $this->belongsTo(Inventory::class, 'inventario_id');
  }
}
