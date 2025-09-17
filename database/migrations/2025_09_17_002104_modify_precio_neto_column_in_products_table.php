<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Modificar la columna precio_neto para aumentar su tamaño de DECIMAL(8,2) a DECIMAL(12,2)
            $table->decimal('precio_neto', 12, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Revertir a la definición original
            $table->decimal('precio_neto', 8, 2)->change();
        });
    }
};
