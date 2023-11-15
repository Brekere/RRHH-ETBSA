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
        Schema::create('ausencias_feriados', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('ausencia_id');
            $table->unsignedBigInteger('feriado_id');

            $table->foreign('ausencia_id')->references('id')->on('ausencias')->onDelete('cascade');
            $table->foreign('feriado_id')->references('id')->on('feriados')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ausencias_feriados');
    }
};
