<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
  return Inertia::render('Welcome', [
    'canLogin' => Route::has('login'),
    'canRegister' => Route::has('register'),
    'laravelVersion' => Application::VERSION,
    'phpVersion' => PHP_VERSION,
  ]);
});

Route::middleware([
  'auth:sanctum',
  config('jetstream.auth_session'),
  'verified',
])->group(function () {
//  Route::get('/', [
//    App\Http\Controllers\PageController::class,
//    'index'
//  ])->name('dashboard');
  Route::get('/', function () {
    return redirect('/appointment');
  })->name('dashboard');

  //Route::resource('notes', App\Http\Controllers\NoteController::class);
  Route::resource('customer', App\Http\Controllers\CustomerController::class);
  Route::resource('service', App\Http\Controllers\ServiceController::class);
  Route::resource('appointment', App\Http\Controllers\AppointmentController::class);
  Route::resource('supplier', App\Http\Controllers\SupplierController::class);
  Route::resource('product', App\Http\Controllers\ProductController::class);
  Route::resource('sale', App\Http\Controllers\SaleController::class);
  Route::resource('inventory', App\Http\Controllers\InventoryController::class);
  Route::resource('addition', App\Http\Controllers\AdditionController::class);
  Route::resource('chat', App\Http\Controllers\ChatController::class);
  Route::put('appointment/move-and-update/{id}', [App\Http\Controllers\AppointmentController::class, 'moveAndUpdate']);
});
