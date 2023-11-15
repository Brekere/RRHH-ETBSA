<?php

namespace Database\Seeders;

use App\Models\Ausencia;
use App\Models\Empleado;
use App\Models\Feriado;
use App\Models\Motivo;
use App\Models\Status;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AusenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Ausencia::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        for ($i = 1; $i < 10; $i++) {
            Ausencia::create(
                [
                    'fecha_de_llenado' => now(),
                    'fecha_de_inicio' => now(),
                    'fecha_de_termino' => now(),
                    'dias_disfrute' => $i,

                    'empleado_id' => Empleado::inRandomOrder()->first()->id,
                    'status_id' => Status::inRandomOrder()->first()->id,
                    'motivo_id' => Motivo::inRandomOrder()->first()->id,
                ]
            );
        }
    }
}
