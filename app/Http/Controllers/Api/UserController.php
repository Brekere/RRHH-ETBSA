<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\PutRequest;
use App\Http\Requests\User\StoreRequest;

class UserController extends Controller
{

    public function index()
    {
       return response()->json(User::paginate(5));
    }

    public function all()
    {
        return response()->json(User::get());
    }

    public function store(StoreRequest $request)
    {
        return response()->json(User::create($request->validated()));
    }

    public function show(User $user)
    {
        return response()->json($user);
    }

    public function update(PutRequest $request, User $user)
    {
        $user->update($request->validated());
        return response()->json($user);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json("ok");
    }
}
