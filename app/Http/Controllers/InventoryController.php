<?php

namespace App\Http\Controllers;

use App\Models\addition;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InventoryController extends Controller
{
  public function index()
  {
    $inventory = Inventory::all()->map(function ($model) {
      return [
        'id' => $model->id,
        'cantidad' => $model->cantidad,
        'producto' => $model->product->nombre,
      ];
    });
    $additions = addition::query()
      ->orderBy('created_at', 'desc')
      ->get()
      ->map(function ($model) {
        return [
          'id' => $model->id,
          'cantidad' => $model->cantidad,
          'proveedor' => $model->proveedor->nombre,
          'inventario' => $model->inventario->product->nombre,
          'fecha' => $model->created_at->format('d/m/Y H:i'),
        ];
      });

    return Inertia::render('Inventory/Inventory', [
      'inventory_items' => $inventory,
      'additions' => $additions,
    ]);
  }
}
