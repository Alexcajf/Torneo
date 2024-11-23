<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TorneoController;
use App\Http\Controllers\ParticipanteController;

// Ruta para la página de inicio (Home)
Route::get('/', function () {
    return view('home');
})->name('home'); // Asignar nombre a la ruta

// Rutas para los Torneos
Route::resource('torneos', TorneoController::class);
Route::get('torneos/{id}/brackets', [TorneoController::class, 'showBrackets'])->name('torneos.showBrackets');
Route::put('torneos/{id}/brackets', [TorneoController::class, 'updateBrackets'])->name('torneos.updateBrackets');

// Rutas para los Participantes 
Route::resource('participantes', ParticipanteController::class);