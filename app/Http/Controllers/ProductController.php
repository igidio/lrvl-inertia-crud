<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Supplier;
use Database\Seeders\CategorySeeder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
  public function index()
  {
    return Inertia::render('Product/Product', [
      'products' => Product::all()->map(function ($model) {
        return [
          'id' => $model->id,
          'nombre' => $model->nombre,
          'descripcion' => $model->descripcion,
          'precio' => $model->precio,
          'categoria' => $model->category->nombre,
        ];
      })
    ]);
  }

  public function create()
  {
    $categories = Category::all();
    return Inertia::render('Product/Create', compact('categories'));
  }

  public function store(Request $request)
  {
    $request->validate([
      'nombre' => 'required',
      'descripcion' => 'required',
      'precio' => 'required',
      'id_categoria' => 'required',
      'imagen' => 'nullable|image|max:2048',
    ]);

    $data = $request->except('imagen');

    if ($request->hasFile('imagen') && $request->file('imagen')->isValid()) {
      $path = $request->file('imagen')->store('products', 'public');
      $data['imagen'] = $path;
    }

    $product = Product::query()->create($data);
    Inventory::query()->create([
      'cantidad' => 0,
      'id_producto' => $product->id,
    ]);
    return redirect()->route('product.index')->with('status', 'Producto creado con éxito');
  }

  public function edit($id)
  {
    $product = Product::query()->findOrFail($id);
    $categories = Category::all();
    return Inertia::render('Product/Edit', compact('product', 'categories'));
  }

  public function update(Request $request, Product $product)
  {
    $product->update($request->all());
    return redirect()->route('product.index')->with('status', 'Producto actualizado con éxito');
  }

  public function destroy(Product $product)
  {
    try {
      $product->delete();
      return redirect()->route('product.index')->with('status', 'Producto eliminado con éxito');
    } catch (\Exception $e) {
      return redirect()->back()->with('error', 'No se pudo eliminar el producto, es posible que existan registros asociados a este producto');
    }
  }
}
