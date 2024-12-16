<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Detail;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SaleController extends Controller
{
  public function index()
  {
    return Inertia::render('Sale/Sale', [
      'sales' => Sale::orderBy('created_at', 'desc')->get()->map(function ($model) {
        return [
          'id' => $model->id,
          'fecha' => $model->created_at->format('Y-m-d H:i:s'),
          'total' => $model->total,
          'cliente' => $model->customer->nombres . ' ' . $model->customer->apellidos,
        ];
      })
    ]);
  }

  public function create()
  {
    $products = Product::all();
    $customers = Customer::all();
    return Inertia::render('Sale/Create', compact('products', 'customers'));
  }

  public function store(Request $request)
  {
    \DB::beginTransaction();

    try {
      $request->validate([
        'id_cliente' => 'required',
        'productos' => 'required',
        'total' => 'required',
      ]);

      $sale = Sale::query()->create([
        'id_cliente' => $request->id_cliente,
        'fecha' => now(),
        'total' => $request->total,
      ]);

      foreach ($request->productos as $producto) {
        $inventory = Inventory::query()->where('id_producto', $producto['id'])->first();

        if ($inventory->cantidad < $producto['cantidad']) {
          \DB::rollBack();
          return redirect()->back()->with('error', 'Cantidad insuficiente en el inventario para el producto: ' . $inventory->product->nombre . ', disponible en el inventario: ' . $inventory->cantidad . ' unidades.');
        }

        Detail::query()->create([
          'id_venta' => $sale->id,
          'id_producto' => $producto['id'],
          'cantidad' => $producto['cantidad'],
          'precio' => Product::query()->find($producto['id'])->precio * $producto['cantidad'],
        ]);

        $inventory->decrement('cantidad', $producto['cantidad']);

      }
      \DB::commit();
      return redirect()->route('sale.index')->with('status', 'Venta realizada con éxito');
    } catch (\Exception $e) {
      \DB::rollBack();
      return redirect()->back()->with('error', 'Ocurrió un error al realizar la venta');
    }
  }

  public function show($id)
  {
    $sale = Sale::with(['customer', 'details.product'])->findOrFail($id);

    return Inertia::render('Sale/Show', [
      'sale' => [
        'id' => $sale->id,
        'fecha' => $sale->created_at->format('Y-m-d H:i:s'),
        'total' => $sale->total,
        'cliente' => $sale->customer->nombres . ' ' . $sale->customer->apellidos,
        'productos' => $sale->details->map(function ($detail) {
          return [
            'id' => $detail->product->id,
            'nombre' => $detail->product->nombre,
            'cantidad' => $detail->cantidad,
            'precio' => $detail->precio,
          ];
        }),
      ],
    ]);
  }

}
