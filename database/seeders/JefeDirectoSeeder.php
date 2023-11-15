<?php

namespace Database\Seeders;

use App\Models\Empleado;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JefeDirectoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=1; $i < 10; $i++) { 
            $jefe = Empleado::inRandomOrder()->first();
            $empleado = Empleado::find($i);

            if($empleado){
                $empleado->jefe_directo = $jefe->id;

                $empleado->save();
            }

            
        }
    }
}

