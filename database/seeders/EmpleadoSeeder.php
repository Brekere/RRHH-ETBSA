<?php

namespace Database\Seeders;

use App\Models\Cargo;
use App\Models\Departamento;
use App\Models\User;
use App\Models\Empleado;
use App\Models\Expediente;
use App\Models\Linea;
use App\Models\Periodo;
use App\Models\Sucursal;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Nette\Utils\Floats;

class EmpleadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Empleado::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        for ($i = 1; $i < 10; $i++) {
            Empleado::create(
                [
                    'nombre' => "Empleado $i",
                    'apellido_paterno' => "Apellido paterno $i",
                    'apellido_materno' => "Apellido Materno $i",
                    'curp' => Str::random(18),
                    'rfc' => Str::random(13),
                    'imss' => rand(10000000000,99999999999),
                    'domicilio' => "Domicilio $i",
                    'telefono' => rand(1000000000,9999999999),
                    'fecha_de_ingreso' => now(),
                    'cuenta_de_nomina' => Str::random(20),

                    'user_id' => User::inRandomOrder()->first()->id,
                    'sucursal_id' => Sucursal::inRandomOrder()->first()->id,
                    'linea_id' => Linea::inRandomOrder()->first()->id,
                    'departamento_id' => Departamento::inRandomOrder()->first()->id,
                    'cargo_id' => Cargo::inRandomOrder()->first()->id,
                    'expediente_id' => Expediente::inRandomOrder()->first()->id,
                    'periodo_id' => Periodo::inRandomOrder()->first()->id,

                ]
            );
        }
    }
}
