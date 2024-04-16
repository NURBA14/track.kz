<?php

use App\Http\Controllers\Web\Admin\TrackController;
use Illuminate\Support\Facades\Route;


Route::prefix("admin")->middleware("admin")->group(function () {
    Route::resource("/tracks", TrackController::class);
});