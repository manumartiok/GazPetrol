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
        Schema::create('producto_fotos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('productos_id');
            $table->foreign('productos_id')->references('id')->on('productos')->onDelete('cascade');
            $table->string('orden')->nullable();
            $table->string('foto');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producto_fotos');
    }
};
