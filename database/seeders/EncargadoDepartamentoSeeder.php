<?php

namespace Database\Seeders;

use App\Models\Empleado;
use App\Models\Departamento;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EncargadoDepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=1; $i < 10; $i++) { 
            $encargado = Empleado::inRandomOrder()->first();
            $departamento = Departamento::find($i);

            if($departamento){
                $departamento->encargado = $encargado->id;

                $departamento->save();
            }

            
        }
    }
}
