<?php

namespace App\Http\Controllers\Api;

use App\Models\Empleado;
use App\Http\Controllers\Controller;
use App\Http\Requests\Empleado\PutRequest;
use App\Http\Requests\Empleado\StoreRequest;

class EmpleadoController extends Controller
{

    public function index()
    {
        return response()->json(Empleado::paginate(5));
    }

    public function all()
    {
        return response()->json(Empleado::get());
    }

    public function store(StoreRequest $request)
    {
        return response()->json(Empleado::create($request->validated()));
    }

    public function show(Empleado $empleado)
    {
        return response()->json($empleado);
    }

    public function update(PutRequest $request, Empleado $empleado)
    {
        $empleado->update($request->validated());
        return response()->json($empleado);
    }

    public function destroy(Empleado $empleado)
    {
        $empleado->delete();
        return response()->json("ok");
    }

    /*-----------------------------------------Metodos_de_busquedas-----------------------------------*/

    function obtenerEmpleadosPorSucursal($sucursalId)
    {
        $empleados = Empleado::where('sucursal_id', $sucursalId)->get();

        if ($empleados->isEmpty()) {
            return response()->json(['error' => 'No hay empleados para la sucursal proporcionada.']);
        }

        return $empleados;
    }

    function obtenerEmpleadosPorLinea($lineaId)
    {
        $empleados = Empleado::where('linea_id', $lineaId)->get();

        if ($empleados->isEmpty()) {
            return response()->json(['error' => 'No hay empleados para la linea proporcionada.']);
        }

        return $empleados;
    }

    function obtenerEmpleadosPorDepartamento($departamentoId)
    {
        $empleados = Empleado::where('departamento_id', $departamentoId)->get();

        if ($empleados->isEmpty()) {
            return response()->json(['error' => 'No hay empleados para el departamento proporcionado.']);
        }

        return $empleados;
    }

    function obtenerEmpleadosPorCargo($cargoId)
    {
        $empleados = Empleado::where('cargo_id', $cargoId)->get();

        if ($empleados->isEmpty()) {
            return response()->json(['error' => 'No hay empleados con el cargo proporcionado.']);
        }

        return $empleados;
    }

    function obtenerEmpleadosPorJefeDirecto($jefe_directoId)
    {
        $empleados = Empleado::where('jefe_directo', $jefe_directoId)->get();

        if ($empleados->isEmpty()) {
            return response()->json(['error' => 'No hay empleados con el jefe directo proporcionado.']);
        }

        return $empleados;
    }

}
