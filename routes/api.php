<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\ImageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
  return $request->user();
})->middleware('auth:sanctum');
Route::post('chat', [ChatController::class, 'index']);
Route::post('chat/select', [ChatController::class, 'select']);
Route::post('image', [ImageController::class, 'index']);
