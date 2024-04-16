<?php

namespace App\Http\Controllers\Web\Security;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Security\RegRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegController extends Controller
{
    public function register()
    {
        return view("security.reg");
    }
    public function store(RegRequest $request)
    {
        $user = User::create([
            "name" => $request->validated("name"),
            "email" => $request->validated("email"),
            "password" => bcrypt($request->validated("password"))
        ]);
        Auth::login($user);
        return redirect()->route("client.home")->with("success", "You are logged");
    }
}
