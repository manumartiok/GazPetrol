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
        Schema::create('nosotros', function (Blueprint $table) {
            $table->id();
            $table->string('video');
            $table->string('foto');
            $table->string('texto_chico1');
            $table->string('texto_grande2');
            $table->text('descripcion');
            $table->string('icono1');
            $table->string('nombre_icono1');
            $table->text('texto_icono1');
            $table->string('icono2');
            $table->string('nombre_icono2');
            $table->text('texto_icono2');
            $table->string('icono3');
            $table->string('nombre_icono3');
            $table->text('texto_icono3');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nosotros');
    }
};
