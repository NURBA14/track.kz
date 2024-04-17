<?php

use App\Http\Controllers\Api\V1\TrackController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResources([
    "tracks" => TrackController::class,
]);