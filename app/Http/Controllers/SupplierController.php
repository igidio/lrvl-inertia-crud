<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Inertia\Inertia;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
  public function index()
  {
    return Inertia::render('Supplier', [
      'suppliers' => Supplier::all()->map(function ($model) {
        return [
          'id' => $model->id,
          'nombre' => $model->nombre,
          'telefono' => $model->telefono,
          'email' => $model->email,
        ];
      })
    ]);
  }

  public function edit($id)
  {
    $supplier = Supplier::query()->findOrFail($id);
    return Inertia::render('Supplier/Edit', compact('supplier'));
  }

  public function update(Request $request, Supplier $supplier)
  {
    $supplier->update($request->all());
    return redirect()->route('supplier.index')->with('status', 'Proveedor actualizado con éxito');
  }

  public function destroy(Supplier $supplier)
  {
    try {
      $supplier->delete();
      return redirect()->route('supplier.index')->with('status', 'Proveedor eliminado con éxito');
    } catch (\Exception $e) {
      return redirect()->back()->with('error', 'No se pudo eliminar el proveedor, es posible que existan productos asociados a este proveedor');
    }
  }
}
