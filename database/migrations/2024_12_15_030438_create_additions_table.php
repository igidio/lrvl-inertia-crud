<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('adicion', function (Blueprint $table) {
      $table->id();
      $table->foreignId('proveedor_id')->constrained('proveedor');
      $table->foreignId('inventario_id')->constrained('inventario');
      $table->integer('cantidad');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('adicion');
  }
};
