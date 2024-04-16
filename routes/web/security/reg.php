<?php

use App\Http\Controllers\Web\Security\LoginController;
use App\Http\Controllers\Web\Security\RegController;
use Illuminate\Support\Facades\Route;

Route::get('/register', [RegController::class, "register"])->name("security.reg.index")->middleware("guest");
Route::post('/register', [RegController::class, "store"])->name("security.reg.store")->middleware("guest");