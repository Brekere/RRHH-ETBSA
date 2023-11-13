<?php

namespace App\Http\Controllers\Api;

use App\Models\Periodo;
use App\Http\Controllers\Controller;
use App\Http\Requests\Periodo\PutRequest;
use App\Http\Requests\Periodo\StoreRequest;

class PeriodoController extends Controller
{

    public function index()
    {
       return response()->json(Periodo::paginate(5));
    }

    public function all()
    {
        return response()->json(Periodo::get());
    }

    public function store(StoreRequest $request)
    {
        return response()->json(Periodo::create($request->validated()));
    }

    public function show(Periodo $periodo)
    {
        return response()->json($periodo);
    }

    public function update(PutRequest $request, Periodo $periodo)
    {
        $periodo->update($request->validated());
        return response()->json($periodo);
    }

    public function destroy(Periodo $periodo)
    {
        $periodo->delete();
        return response()->json("ok");
    }
}
