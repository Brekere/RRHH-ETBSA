<?php

namespace App\Http\Controllers\Api;

use App\Models\Cargo;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cargo\PutRequest;
use App\Http\Requests\Cargo\StoreRequest;

class CargoController extends Controller
{

    public function index()
    {
       return response()->json(Cargo::paginate(5));
    }

    public function all()
    {
        return response()->json(Cargo::get());
    }

    public function store(StoreRequest $request)
    {
        return response()->json(Cargo::create($request->validated()));
    }

    public function show(Cargo $cargo)
    {
        return response()->json($cargo);
    }

    public function update(PutRequest $request, Cargo $cargo)
    {
        $cargo->update($request->validated());
        return response()->json($cargo);
    }

    public function destroy(Cargo $cargo)
    {
        $cargo->delete();
        return response()->json("ok");
    }
}
