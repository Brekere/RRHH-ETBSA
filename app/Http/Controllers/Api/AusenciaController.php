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

    public function show(Ausencia $ausencium)
    {
        return response()->json($ausencium);
    }

    public function update(PutRequest $request, Ausencia $ausencium)
    {
        $ausencium->update($request->validated());
        return response()->json($ausencium);
    }

    public function destroy(Ausencia $ausencium)
    {
        $ausencium->delete();
        return response()->json("ok");
    }
}
