<?php

namespace Database\Seeders;

use App\Models\Empleado;
use App\Models\Sucursal;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EncargadoSucursalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=1; $i < 10; $i++) { 
            $encargado = Empleado::inRandomOrder()->first();
            $sucursal = Sucursal::find($i);

            if($sucursal){
                $sucursal->encargado = $encargado->id;

                $sucursal->save();
            }

            
        }
    }
}
