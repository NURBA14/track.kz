<?php

use App\Http\Controllers\Web\Client\AlbumController;
use App\Http\Controllers\Web\Client\TrackController;
use Illuminate\Support\Facades\Route;

Route::controller(TrackController::class)->group(function () {
    Route::get("/track/show/{track}", "show")->name("client.track.show");
    Route::get("/track/download/{track}", "download")->name("client.track.download");
    Route::get("/track", "index")->name("client.track.index");
});