<?php

use App\Http\Controllers\Web\Security\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, "login"])->name("security.login.index")->middleware("guest");
Route::post('/login', [LoginController::class, "store"])->name("security.login.store")->middleware("guest");


Route::post('/logout', [LoginController::class, "logout"])->name("security.logout")->middleware("auth");