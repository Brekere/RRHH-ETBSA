<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Cargo;
use App\Models\Linea;
use App\Models\Periodo;
use Nette\Utils\Floats;
use App\Models\Empleado;
use App\Models\Sucursal;
use App\Models\Expediente;
use Illuminate\Support\Str;
use App\Models\Departamento;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
            $usuario = User::find($i);
            $expediente = Expediente::find($i);
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
                    'fecha_de_ingreso' => Carbon::now()->subDays(rand(1, 30)),
                    'cuenta_de_nomina' => Str::random(20),

                    'user_id' => $usuario->id,
                    'sucursal_id' => Sucursal::inRandomOrder()->first()->id,
                    'linea_id' => Linea::inRandomOrder()->first()->id,
                    'departamento_id' => Departamento::inRandomOrder()->first()->id,
                    'cargo_id' => Cargo::inRandomOrder()->first()->id,
                    'expediente_id' => $expediente->id,
                    'periodo_id' => Periodo::inRandomOrder()->first()->id,

                ]
            );
        }
    }
}
