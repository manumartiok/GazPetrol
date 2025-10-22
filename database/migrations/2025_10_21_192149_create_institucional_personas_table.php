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
        Schema::create('institucional_personas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->string('foto')->nullable();
            $table->string('cargo')->nullable();
            $table->text('texto1')->nullable();
            $table->text('texto2')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('institucional_personas');
    }
};
