<?php

namespace Database\Seeders;

use App\Models\Linea;
use App\Models\Sucursal;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LineaSucursalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sucursales = Sucursal::all();
        $lineas = Linea::all();

        foreach ($sucursales as $sucursal) {
            $linea = $lineas->random();

            DB::table('sucursales_lineas')->insert([
                'sucursal_id' => $sucursal->id,
                'linea_id' => $linea->id,
            ]);
        }
    }
}
