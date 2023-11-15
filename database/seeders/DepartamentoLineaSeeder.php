<?php

namespace Database\Seeders;

use App\Models\Linea;
use App\Models\Departamento;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DepartamentoLineaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lineas = Linea::all();
        $departamentos = Departamento::all();

        foreach ($lineas as $linea) {
            $departamento = $departamentos->random();

            DB::table('departamentos_lineas')->insert([
                'linea_id' => $linea->id,
                'departamento_id' => $departamento->id,
            ]);
        }
    }
}
