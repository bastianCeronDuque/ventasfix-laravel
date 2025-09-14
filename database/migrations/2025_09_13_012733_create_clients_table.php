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
        Schema::create('clients', function (Blueprint $table) {
            $table->id(); 
            $table->string('rut_empresa');
            $table->string('rubro');
            $table->string('razon_social');
            $table->string('telefono');
            $table->string('direccion');
            $table->string('nombre_de_la_persona_de_contacto');
            $table->string('email_de_la_persona_de_contacto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
