<?php

namespace Database\Seeders;

use App\Models\Periodo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PeriodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Periodo::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        for ($i = 1; $i < 10; $i++) {
            Periodo::create(
                [
                    'años'=>$i,
                    'dias_correspondientes' => $i,
                    'regimen' => "Regimen $i"
                ]
            );
        }
    }
}
