<?php

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;

Route::get('/login', function (){
    return redirect(route('login.view'));
});

Route::post('/login', [ApiController::class, 'login'])->name('login');
Route::post('/register', [ApiController::class, 'register'])->name('register');

// ROUTE USER

Route::get('/me', [ApiController::class, 'me'])->name('user');
Route::put('/user/update', [ApiController::class, 'alterar_perfil'])->name('user.update');
Route::get('/users',[ApiController::class, 'users'])->name('users');

// ROUTE RULES

Route::get('/rules',[ApiController::class, 'users_rule'])->name('rules');
Route::post('/rules', [ApiController::class, 'create_rule'])->name('create.rules');

// ROUTE BANCOS

Route::post('/bancos', [ApiController::class, 'create_banco'])->name('create.banco');
Route::get('/bancos', [ApiController::class, 'bancos'])->name('bancos');

// ROUTE LOGS

Route::post('/logs', [ApiController::class, 'create_log'])->name('create.logs');
Route::get('/logs', [ApiController::class, 'logs'])->name('logs');

// ROUTE CAMPANHA

Route::post('/create_campanha', [ApiController::class, 'create_campanha'])->name('create.campanha');









