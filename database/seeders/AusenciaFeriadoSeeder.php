<?php

namespace Database\Seeders;

use App\Models\Feriado;
use App\Models\Ausencia;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AusenciaFeriadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ausencias = Ausencia::all();
        $feriados = Feriado::all();

        foreach ($ausencias as $ausencia) {
            $feriado = $feriados->random();

            DB::table('ausencias_feriados')->insert([
                'ausencia_id' => $ausencia->id,
                'feriado_id' => $feriado->id,
            ]);
        }
    }
}
