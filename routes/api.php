<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\ReservaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
 */
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name("register");
Route::middleware('auth:api')->group(function () {
    Route::get('/horarios', [HorarioController::class, 'index']);
    Route::get('/all-horarios', [HorarioController::class, 'showAll']);
    Route::post('/reserva', [ReservaController::class, 'store']);
    Route::get('/reserva', [ReservaController::class, 'index']);

});
