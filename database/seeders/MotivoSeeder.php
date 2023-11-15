<?php

namespace Database\Seeders;

use App\Models\Motivo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MotivoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Motivo::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        for ($i = 1; $i < 10; $i++) {
            Motivo::create(
                [
                    'nombre' => "Motivo $i",
                ]
            );
        }
    }
}
