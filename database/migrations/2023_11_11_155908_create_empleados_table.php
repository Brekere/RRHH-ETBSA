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
            $table->id('numero_de_empleado');

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

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('sucursal_id')->references('id')->on('sucursales');
            $table->foreign('linea_id')->references('id')->on('lineas');
            $table->foreign('departamento_id')->references('id')->on('departamentos');
            $table->foreign('cargo_id')->references('id')->on('cargos');
            $table->foreign('jefe_directo')->references('id')->on('empleados');
            $table->foreign('expediente_id')->references('id')->on('expedientes');
            $table->foreign('periodo_id')->references('id')->on('periodos');
            
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
