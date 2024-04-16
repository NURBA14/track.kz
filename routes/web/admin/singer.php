<?php

use App\Http\Controllers\Web\Admin\SingerController;
use Illuminate\Support\Facades\Route;


Route::prefix("admin")->middleware("admin")->group(function () {
    Route::resource("/singers", SingerController::class);
});