<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SaleController extends Controller
{
    public function index()
    {
      return Inertia::render('Sale/Sale', [
        'sales' => Sale::all()->map(function ($model) {
          return [
            'id' => $model->id,
            'fecha' => $model->created_at->format('Y-m-d H:i:s'),
            'total' => $model->total,
            'cliente' => $model->customer->nombres . ' ' . $model->customer->apellidos,
          ];
        })
      ]);
    }
}
