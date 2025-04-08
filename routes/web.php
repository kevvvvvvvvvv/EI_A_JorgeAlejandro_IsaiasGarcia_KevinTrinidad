<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalonController;
use App\Http\Controllers\PublicacionController;
use App\Http\Controllers\ReservaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::resource('salons', SalonController::class);
Route::resource('publicacions', PublicacionController::class);
Route::resource('reservas', ReservaController::class);

Route::get('/salon/general', [SalonController::class, 'mostrarGeneral'])->name('salon.general');

Route::get('/reserva/calendario', [ReservaController::class, 'mostrarCalendario']);

Route::get('/publicacion/general', [PublicacionController::class, 'general'])->name('publicacion.general');