<?php

use App\Http\Controllers\Api\V1\SecurityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(SecurityController::class)->group(function () {
   Route::post("/login", "login");
   Route::post("/register", "reg"); 
});