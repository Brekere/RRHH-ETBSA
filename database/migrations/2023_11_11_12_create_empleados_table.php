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
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();

            $table->string('nombre');
            $table->string('apellido_paterno');
            $table->string('apellido_materno');
            $table->string('curp');
            $table->string('rfc');
            $table->string('imss');
            $table->string('domicilio');
            $table->string('telefono');
            $table->date('fecha_de_ingreso');
            $table->string('cuenta_de_nomina');

            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('sucursal_id')->nullable();
            $table->unsignedBigInteger('linea_id')->nullable();
            $table->unsignedBigInteger('departamento_id')->nullable();
            $table->unsignedBigInteger('cargo_id')->nullable();
            $table->unsignedBigInteger('expediente_id')->nullable();
            $table->unsignedBigInteger('periodo_id')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('sucursal_id')->references('id')->on('sucursals')->onDelete('set null');
            $table->foreign('linea_id')->references('id')->on('lineas')->onDelete('set null');
            $table->foreign('departamento_id')->references('id')->on('departamentos')->onDelete('set null');
            $table->foreign('cargo_id')->references('id')->on('cargos')->onDelete('set null');
            $table->foreign('expediente_id')->references('id')->on('expedientes')->onDelete('set null');
            $table->foreign('periodo_id')->references('id')->on('periodos')->onDelete('set null');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
