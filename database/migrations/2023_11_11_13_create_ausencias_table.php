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
        Schema::create('ausencias', function (Blueprint $table) {
            $table->id();

            $table->date('fecha_de_llenado');
            $table->date('fecha_de_inicio');
            $table->date('fecha_de_termino');
            $table->integer('dias_disfrute');

            $table->unsignedBigInteger('empleado_id');
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('motivo_id');

            $table->foreign('empleado_id')->references('id')->on('empleados')->onDelete('cascade');
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');
            $table->foreign('motivo_id')->references('id')->on('motivos')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ausencias');
    }
};
