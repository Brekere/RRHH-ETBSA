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

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('sucursal_id');
            $table->unsignedBigInteger('linea_id');
            $table->unsignedBigInteger('departamento_id');
            $table->unsignedBigInteger('cargo_id');
            $table->unsignedBigInteger('expediente_id');
            $table->unsignedBigInteger('periodo_id');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('sucursal_id')->references('id')->on('sucursals')->onDelete('cascade');
            $table->foreign('linea_id')->references('id')->on('lineas')->onDelete('cascade');
            $table->foreign('departamento_id')->references('id')->on('departamentos')->onDelete('cascade');
            $table->foreign('cargo_id')->references('id')->on('cargos')->onDelete('cascade');
            $table->foreign('expediente_id')->references('id')->on('expedientes')->onDelete('cascade');
            $table->foreign('periodo_id')->references('id')->on('periodos')->onDelete('cascade');
            
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
