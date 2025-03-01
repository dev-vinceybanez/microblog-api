<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function store(RegisterRequest $registerRequest)
    {
        $validated = $registerRequest->validated();

        $user = User::create($validated);

        return response()->json($user, 201);
    }
}
