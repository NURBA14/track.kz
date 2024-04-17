<?php

use App\Http\Controllers\Api\V1\SingerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResources([
    "singers" => SingerController::class,
]);