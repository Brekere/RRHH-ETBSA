<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CargoController;
use App\Http\Controllers\Api\AusenciaController;
use App\Http\Controllers\Api\EmpleadoController;
use App\Http\Controllers\Api\DocumentoController;
use App\Http\Controllers\Api\ExpedienteController;
use App\Http\Controllers\Api\DepartamentoController;
use App\Http\Controllers\Api\FeriadoController;
use App\Http\Controllers\Api\LineaController;
use App\Http\Controllers\Api\MotivoController;
use App\Http\Controllers\Api\PeriodoController;
use App\Http\Controllers\Api\RequisitoController;
use App\Http\Controllers\Api\StatusController;
use App\Http\Controllers\Api\SucursalController;
use App\Models\Ausencia;
use App\Models\Cargo;
use App\Models\Departamento;
use App\Models\Documento;
use App\Models\Empleado;
use App\Models\Expediente;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('ausencia/all',[AusenciaController::class,'all']);
Route::get('cargo/all',[CargoController::class,'all']);
Route::get('departamento/all',[DepartamentoController::class,'all']);
Route::get('documento/all',[DocumentoController::class,'all']);
Route::get('empleado/all',[EmpleadoController::class,'all']);
Route::get('expediente/all',[ExpedienteController::class,'all']);
Route::get('feriado/all',[FeriadoController::class,'all']);
Route::get('linea/all',[LineaController::class,'all']);
Route::get('motivo/all',[MotivoController::class,'all']);
Route::get('periodo/all',[PeriodoController::class,'all']);
Route::get('requisito/all',[RequisitoController::class,'all']);
Route::get('status/all',[StatusController::class,'all']);
Route::get('sucursal/all',[SucursalController::class,'all']);

Route::resource('ausencia',AusenciaController::class)->except("create","edit");
Route::resource('cargo',CargoController::class)->except("create","edit");
Route::resource('departamento',DepartamentoController::class)->except("create","edit");
Route::resource('documento',DocumentoController::class)->except("create","edit");
Route::resource('empleado',EmpleadoController::class)->except("create","edit");
Route::resource('expediente',ExpedienteController::class)->except("create","edit");
Route::resource('feriado',FeriadoController::class)->except("create","edit");
Route::resource('linea',LineaController::class)->except("create","edit");
Route::resource('motivo',MotivoController::class)->except("create","edit");
Route::resource('periodo',PeriodoController::class)->except("create","edit");
Route::resource('requisito',RequisitoController::class)->except("create","edit");
Route::resource('status',StatusController::class)->except("create","edit");
Route::resource('sucursal',SucursalController::class)->except("create","edit");













