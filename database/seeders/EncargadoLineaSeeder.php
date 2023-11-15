<?php

namespace Database\Seeders;

use App\Models\Linea;
use App\Models\Empleado;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EncargadoLineaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=1; $i < 10; $i++) { 
            $encargado = Empleado::inRandomOrder()->first();
            $linea = Linea::find($i);

            if($linea){
                $linea->encargado = $encargado->id;

                $linea->save();
            }

            
        }
    }
}
