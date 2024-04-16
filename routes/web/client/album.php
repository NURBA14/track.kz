<?php

use App\Http\Controllers\Web\Client\AlbumController;
use Illuminate\Support\Facades\Route;

Route::controller(AlbumController::class)->group(function () {
    Route::get("/album/show/{album}", "show")->name("client.album.show");
    Route::get("/album/search/", "search")->name("client.album.search");
});