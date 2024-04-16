<?php

namespace App\Http\Controllers\Web\Security;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Security\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view("security.login");
    }
    public function store(LoginRequest $request)
    {
        $email = $request->validated("email");
        $password = $request->validated("password");
        if(Auth::attempt(["email" => $email, "password" => $password])){
            return redirect()->route("client.home")->with("success", "You are logged");
        }
        return redirect()->back()->with("error", "Inccorect Email or Password");
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route("client.home")->with("You are logout");
    }
}
