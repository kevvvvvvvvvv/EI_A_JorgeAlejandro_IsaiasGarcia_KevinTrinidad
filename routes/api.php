<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\PublicacionController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\Api\SalonController;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('salons', SalonController::class);
Route::apiResource('publicacions', PublicacionController::class);