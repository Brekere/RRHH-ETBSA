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
        Schema::create('sucursales_lineas', function (Blueprint $table) {
            $table->id();

            $table->foreign('sucursal_id')->references('id')->on('sucursales');
            $table->foreign('linea_id')->references('id')->on('lineas');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sucursales_lineas');
    }
};
