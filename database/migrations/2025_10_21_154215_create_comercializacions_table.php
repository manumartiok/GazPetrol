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
        Schema::create('comercializacions', function (Blueprint $table) {
            $table->id();
            $table->string('orden')->nullable();
            $table->string('foto')->nullable();
            $table->string('titulo')->nullable();
            $table->text('texto')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comercializacions');
    }
};
