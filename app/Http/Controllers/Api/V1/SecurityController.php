<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Security\ApiLoginRequest;
use App\Http\Requests\Api\V1\Security\ApiRegRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SecurityController extends Controller
{
    public function reg(ApiRegRequest $request)
    {
        $user = User::create([
            "email" => $request->validated("email"),
            "name" => $request->validated("name"),
            "password" => bcrypt($request->validated("password"))
        ]);
        $token = $user->createToken("login");
        return response()->json([
            "message" => "You are Registered",
            "token" => $token->plainTextToken
        ], 200);
    }
    public function login(ApiLoginRequest $request)
    {
        $email = $request->validated("email");
        $password = $request->validated("password");
        if(!Auth::attempt(["email" => $email, "password" => $password])){
            return response()->json(["message" => "Incorrect Login or Password"], 401);
        }
        $token = Auth::user()->createToken("login");
        return response()->json(["token" => $token->plainTextToken], 200);
    }
}
