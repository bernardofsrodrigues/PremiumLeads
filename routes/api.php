<?php

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;


Route::post('/register', [ApiController::class, 'register'])->name('register');
Route::post('/login', [ApiController::class, 'login'])->name('login');

// ROUTE USER

Route::get('/user', [ApiController::class, 'me'])->name('user');
Route::put('/user/update', [ApiController::class, 'alterar_perfil'])->name('user.update');

// ROUTE RULES

Route::get('/rules',[ApiController::class, 'users_rule'])->name('rules');
Route::post('/rules', [ApiController::class, 'create_rule'])->name('create.rules');

// ROUTE BANCOS

Route::post('/bancos', [ApiController::class, 'create_banco'])->name('create.banco');
Route::get('/bancos', [ApiController::class, 'bancos'])->name('bancos');

// ROUTE LOGS

Route::post('/logs', [ApiController::class, 'create_log'])->name('create.logs');
Route::get('/logs', [ApiController::class, 'logs'])->name('logs');







