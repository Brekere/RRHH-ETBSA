<?php

namespace App\Http\Controllers\Api;

use App\Models\Feriado;
use App\Http\Controllers\Controller;
use App\Http\Requests\Feriado\PutRequest;
use App\Http\Requests\Feriado\StoreRequest;

class FeriadoController extends Controller
{

    public function index()
    {
       return response()->json(Feriado::paginate(5));
    }

    public function all()
    {
        return response()->json(Feriado::get());
    }

    public function store(StoreRequest $request)
    {
        return response()->json(Feriado::create($request->validated()));
    }

    public function show(Feriado $feriado)
    {
        return response()->json($feriado);
    }

    public function update(PutRequest $request, Feriado $feriado)
    {
        $feriado->update($request->validated());
        return response()->json($feriado);
    }

    public function destroy(Feriado $feriado)
    {
        $feriado->delete();
        return response()->json("ok");
    }
}
