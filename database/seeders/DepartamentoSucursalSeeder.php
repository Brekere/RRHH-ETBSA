<?php

namespace Database\Seeders;

use App\Models\Sucursal;
use App\Models\Departamento;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DepartamentoSucursalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sucursales = Sucursal::all();
        $departamentos = Departamento::all();

        foreach ($sucursales as $sucursal) {
            $departamento = $departamentos->random();

            DB::table('departamentos_sucursales')->insert([
                'sucursal_id' => $sucursal->id,
                'departamento_id' => $departamento->id,
            ]);
        }
    }
}
