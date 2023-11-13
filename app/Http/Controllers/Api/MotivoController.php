<?php

namespace App\Http\Controllers\Api;

use App\Models\Motivo;
use App\Http\Controllers\Controller;
use App\Http\Requests\Motivo\PutRequest;
use App\Http\Requests\Motivo\StoreRequest;

class MotivoController extends Controller
{

    public function index()
    {
       return response()->json(Motivo::paginate(5));
    }

    public function all()
    {
        return response()->json(Motivo::get());
    }

    public function store(StoreRequest $request)
    {
        return response()->json(Motivo::create($request->validated()));
    }

    public function show(Motivo $motivo)
    {
        return response()->json($motivo);
    }

    public function update(PutRequest $request, Motivo $motivo)
    {
        $motivo->update($request->validated());
        return response()->json($motivo);
    }

    public function destroy(Motivo $motivo)
    {
        $motivo->delete();
        return response()->json("ok");
    }
}
