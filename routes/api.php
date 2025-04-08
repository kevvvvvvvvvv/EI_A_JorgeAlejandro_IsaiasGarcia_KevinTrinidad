<?php

use Illuminate\Http\Request;
use App\Http\Controllers\SalonController;
use App\Http\Controllers\PublicacionController;
use App\Http\Controllers\ReservaController;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('salons',SalonController::class);