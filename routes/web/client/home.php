<?php

use App\Http\Controllers\Web\Client\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, "index"])->name("client.home");