<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Feriado;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FeriadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Feriado::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        for ($i = 1; $i < 10; $i++) {
            Feriado::create(
                [
                    'fecha' => Carbon::now()->subDays(rand(1, 30)),
                    'descripcion' => "Feriado $i",
                ]
            );
        }
    }
}
