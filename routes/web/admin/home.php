<?php

use App\Http\Controllers\Web\Admin\HomeController;
use Illuminate\Support\Facades\Route;

Route::prefix("admin")->middleware("admin")->group(function () {
    Route::get('/', [HomeController::class, "index"])->name("admin.home");
});