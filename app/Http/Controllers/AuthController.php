<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index(LoginRequest $loginRequest) {
        $validated = $loginRequest->validated();
        $user = User::where("email", $validated["email"])->first();

        if(!$user || !Hash::check($validated["password"], $user->password)) {
            return response("Unauthorized", 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        return response()->json([
            "user" => $user,
            "message" => "Login Successful!",
            "token", $token
        ], 200);
    }

    public function store(RegisterRequest $registerRequest)
    {
        $validated = $registerRequest->validated();
        $password = Hash::make($validated["password"]);
        $validated["password"] = $password;

        $user = User::create($validated);

        return response()->json($user, 201);
    }
}
