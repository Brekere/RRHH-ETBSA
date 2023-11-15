<?php

namespace Database\Seeders;

use App\Models\Departamento;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Departamento::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        for ($i = 1; $i < 10; $i++) {
            Departamento::create(
                [
                    'nombre' => "Departamento $i",
                ]
            );
        }
    }
}
