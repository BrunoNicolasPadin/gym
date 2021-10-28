<?php

use App\Http\Controllers\Ejercicios\EjercicioController;
use App\Http\Controllers\Entrenamientos\EjercicioEntrenamientoController;
use App\Http\Controllers\Entrenamientos\EntrenamientoController;
use App\Http\Controllers\Entrenamientos\EntrenamientoSerieController;
use App\Http\Controllers\Rutinas\DiaRutinaController;
use App\Http\Controllers\Rutinas\EjercicioDiaController;
use App\Http\Controllers\Rutinas\RutinaController;
use App\Http\Middleware\Authenticate;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('inicio');

/* Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard'); */

Route::middleware([Authenticate::class])->group(function () {
    Route::resource('rutinas', RutinaController::class);
    Route::prefix('rutinas/{rutina_id}')->group(function () {
        Route::resource('dias', DiaRutinaController::class);
        Route::prefix('dias/{dia_rutina_id}')->group(function () {
            Route::resource('ejercicios-del-dia', EjercicioDiaController::class);
        });
    });

    Route::resource('ejercicios', EjercicioController::class);

    Route::resource('entrenamientos', EntrenamientoController::class)->except(['show']);
    Route::get('entrenamientos/paginarEntrenamientos', [EntrenamientoController::class, 'paginarEntrenamientos'])
        ->name('entrenamientos.paginarEntrenamientos');
    Route::prefix('entrenamientos/{entrenamiento_id}')->group(function () {
        Route::resource('ejercicios-del-entrenamiento', EjercicioEntrenamientoController::class);
        Route::prefix('ejercicios-del-entrenamiento/{ejercicio_entrenamiento_id}')->group(function () {
            Route::resource('series', EntrenamientoSerieController::class);
        });
    });
});
