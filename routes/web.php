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
  Route::get('/', [
    App\Http\Controllers\PageController::class,
    'index'
  ])->name('dashboard');
  //Route::resource('notes', App\Http\Controllers\NoteController::class);
  Route::resource('customer', App\Http\Controllers\CustomerController::class);
  Route::resource('service', App\Http\Controllers\ServiceController::class);
});
