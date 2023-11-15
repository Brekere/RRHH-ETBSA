<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(SucursalSeeder::class);
        $this->call(LineaSeeder::class);
        $this->call(DepartamentoSeeder::class);
        $this->call(CargoSeeder::class);
        $this->call(PeriodoSeeder::class);
        $this->call(RequisitoSeeder::class);
        $this->call(DocumentoSeeder::class);
        $this->call(ExpedienteSeeder::class);
        $this->call(EmpleadoSeeder::class);
        $this->call(FeriadosSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(MotivoSeeder::class);
        $this->call(AusenciaSeeder::class);
        $this->call(JefeDirectoSeeder::class);
        $this->call(EncargadoSucursalSeeder::class);
        $this->call(EncargadoLineaSeeder::class);
        $this->call(EncargadoDepartamentoSeeder::class);
        $this->call(LineaSucursalSeeder::class);
        $this->call(DepartamentoSucursalSeeder::class);
        $this->call(DepartamentoLineaSeeder::class);
    }
}
