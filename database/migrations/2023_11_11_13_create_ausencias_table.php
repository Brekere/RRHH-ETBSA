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

            $table->date('fecha_de_inicio');
            $table->date('fecha_de_termino');
            $table->date('fecha_de_regreso');
            $table->integer('dias_disfrute');

            $table->unsignedBigInteger('solicitante')->nullable();
            $table->unsignedBigInteger('quien_cubre')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->unsignedBigInteger('motivo_id')->nullable();
            $table->unsignedBigInteger('feriado_id')->nullable();

            $table->foreign('solicitante')->references('id')->on('empleados')->onDelete('set null');
            $table->foreign('quien_cubre')->references('id')->on('empleados')->onDelete('set null');
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('set null');
            $table->foreign('motivo_id')->references('id')->on('motivos')->onDelete('set null');
            $table->foreign('feriado_id')->references('id')->on('feriados')->onDelete('set null');

            
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
