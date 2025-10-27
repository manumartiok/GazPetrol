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
            $table->string('video')->nullable();
            $table->string('foto')->nullable();
            $table->string('texto_chico1')->nullable();
            $table->string('texto_grande1')->nullable();
            $table->text('descripcion')->nullable();
            $table->string('texto_chico2')->nullable();
            $table->string('texto_grande2')->nullable();
            $table->string('icono1')->nullable();
            $table->string('nombre_icono1')->nullable();
            $table->text('texto_icono1')->nullable();
            $table->string('icono2')->nullable();
            $table->string('nombre_icono2')->nullable();
            $table->text('texto_icono2')->nullable();
            $table->string('icono3')->nullable();
            $table->string('nombre_icono3')->nullable();
            $table->text('texto_icono3')->nullable();

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
