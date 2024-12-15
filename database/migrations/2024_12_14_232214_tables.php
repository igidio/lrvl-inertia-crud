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
    Schema::create('proveedor', function (Blueprint $table) {
      $table->id();
      $table->string('nombre', 255);
      $table->string('telefono', 20)->nullable();
      $table->string('email', 255)->nullable();
      $table->timestamps();
    });

    Schema::create('producto', function (Blueprint $table) {
      $table->id();
      $table->string('nombre', 255);
      $table->text('descripcion')->nullable();
      $table->decimal('precio', 10, 2);
      $table->foreignId('id_categoria')->constrained('categoria');
      $table->timestamps();
    });
    Schema::create('venta', function (Blueprint $table) {
      $table->id();
      $table->foreignId('id_cliente')->constrained('cliente');
      $table->date('fecha');
      $table->decimal('total', 10, 2);
      $table->timestamps();
    });

    Schema::create('detalle', function (Blueprint $table) {
      $table->id();
      $table->foreignId('id_venta')->constrained('venta');
      $table->foreignId('id_producto')->constrained('producto');
      $table->integer('cantidad');
      $table->decimal('precio', 10, 2);
      $table->timestamps();
    });

    Schema::create('inventario', function (Blueprint $table) {
      $table->id();
      $table->foreignId('id_producto')->constrained('producto')->unique();
      $table->integer('cantidad');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('inventario');
    Schema::dropIfExists('detalle');
    Schema::dropIfExists('venta');
    Schema::dropIfExists('producto');
    Schema::dropIfExists('proveedor');
  }
};
