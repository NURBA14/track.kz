<?php

use App\Http\Controllers\Api\V1\AlbumController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResources([
    "albums" => AlbumController::class,
]);