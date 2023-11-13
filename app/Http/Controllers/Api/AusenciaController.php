<?php

namespace App\Http\Controllers\Api;

use App\Models\Ausencia;
use App\Http\Controllers\Controller;
use App\Http\Requests\Ausencia\PutRequest;
use App\Http\Requests\Ausencia\StoreRequest;

class AusenciaController extends Controller
{
    
    public function index()
    {
       return response()->json(Ausencia::paginate(5));
    }

    public function all()
    {
        return response()->json(Ausencia::get());
    }

    public function store(StoreRequest $request)
    {
        return response()->json(Ausencia::create($request->validated()));
    }

    public function show(Ausencia $ausencia)
    {
        return response()->json($ausencia);
    }

    public function update(PutRequest $request, Ausencia $ausencia)
    {
        $ausencia->update($request->validated());
        return response()->json($ausencia);
    }

    public function destroy(Ausencia $ausencia)
    {
        $ausencia->delete();
        return response()->json("ok");
    }
    
}
