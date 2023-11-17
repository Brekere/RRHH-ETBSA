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
        Schema::create('departamentos_sucursales', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('departamento_id')->nullable();
            $table->unsignedBigInteger('sucursal_id')->nullable();

            $table->foreign('departamento_id')->references('id')->on('departamentos')->onDelete('set null');
            $table->foreign('sucursal_id')->references('id')->on('sucursals')->onDelete('set null');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departamentos_sucursales');
    }
};
