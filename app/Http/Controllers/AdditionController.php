<?php

namespace App\Http\Controllers;

use App\Models\addition;
use App\Models\Inventory;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdditionController extends Controller
{
  public function create()
  {
    $inventory_products = Inventory::all()->map(function ($model) {
      return [
        'id' => $model->id,
        'nombre' => $model->product->nombre,
      ];
    });
    $suppliers = Supplier::all()->map(function ($model) {
      return [
        'id' => $model->id,
        'nombre' => $model->nombre,
      ];
    });
    return Inertia::render('Addition/Create', compact('inventory_products', 'suppliers'));
  }

  public function store(Request $request)
  {
    try {
      $request->validate([
        'inventario_id' => 'required',
        'proveedor_id' => 'required',
        'cantidad' => 'required',
      ]);

      addition::query()->create($request->all());
      Inventory::query()->where('id', $request->inventario_id)->increment('cantidad', $request->cantidad);
      return redirect()->route('inventory.index')->with('status', 'Adición creada con éxito');
    } catch (\Exception $e) {
      return redirect()->back()->with('error', $e->getMessage());
    }


  }
}
