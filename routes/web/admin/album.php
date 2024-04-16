<?php

use App\Http\Controllers\Web\Admin\AlbumController;
use Illuminate\Support\Facades\Route;


Route::prefix("admin")->middleware("admin")->group(function () {
    Route::resource("/albums", AlbumController::class);
});