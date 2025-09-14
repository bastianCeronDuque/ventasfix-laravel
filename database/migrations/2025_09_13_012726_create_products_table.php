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
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // El ID único del producto [cite: 1]
            $table->string('sku'); // El SKU [cite: 1]
            $table->string('nombre'); // El nombre del producto [cite: 1]
            $table->text('descripcion_corta'); // La descripción corta [cite: 1]
            $table->text('descripcion_larga'); // La descripción larga [cite: 1]
            $table->string('imagen_del_producto'); // La URL de la imagen [cite: 1]
            $table->decimal('precio_neto', 8, 2); // El precio neto [cite: 1]
            $table->decimal('precio_de_venta', 8, 2); // El precio de venta [cite: 1]
            $table->integer('stock_actual'); // El stock actual [cite: 1]
            $table->integer('stock_minimo'); // El stock mínimo [cite: 1]
            $table->integer('stock_bajo'); // El stock bajo [cite: 1]
            $table->integer('stock_alto'); // El stock alto [cite: 1]
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
