<?php

namespace App\Http\Controllers\Api;

use App\Models\Status;
use App\Http\Controllers\Controller;
use App\Http\Requests\Status\PutRequest;
use App\Http\Requests\Status\StoreRequest;

class StatusController extends Controller
{

    public function index()
    {
       return response()->json(Status::paginate(5));
    }

    public function all()
    {
        return response()->json(Status::get());
    }

    public function store(StoreRequest $request)
    {
        return response()->json(Status::create($request->validated()));
    }

    public function show(Status $status)
    {
        return response()->json($status);
    }

    public function update(PutRequest $request, Status $status)
    {
        $status->update($request->validated());
        return response()->json($status);
    }

    public function destroy(Status $status)
    {
        $status->delete();
        return response()->json("ok");
    }
}
