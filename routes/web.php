<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\AdicionarUsuario;
use Illuminate\Support\Facades\Auth;
use App\Models\Campanhas;


Route::get('/login', [App\Http\Controllers\LoginController::class, 'login'])->name('login.view');

Route::get('/', [App\Http\Controllers\PrincipalController::class, 'index'])->middleware(['auth'])->name('principal.view');

Route::get('/higienizacao/{banco}/{produto}/{id}', [App\Http\Controllers\HigienizacaoController::class, 'paginaBancos'])->middleware(['auth'])->name('higienizacao.view');
Route::post('/higienizacao/{banco}/{produto}/{id}', [App\Http\Controllers\ApiController::class, 'create_campanha'])->middleware(['auth'])->name('higienizacao.view.post');

Route::get('/controle-usuarios', [App\Http\Controllers\UsuariosController::class, 'controleUsuarios'])->middleware(['auth'])->name('controle_usuarios.view');
Route::get('/alterar-situacao/{user_id}', [App\Http\Controllers\UsuariosController::class, 'alterarSituacao'])->middleware(['auth'])->name('alterar_situacao');


Route::get('/controle-bases', [App\Http\Controllers\CampanhasController::class, 'controleBases'])->middleware(['auth'])->name('controle_bases.view');
Route::get('/adicionar-base/{nome}', [App\Http\Controllers\CampanhasController::class, 'adicionarCampanha'])->middleware(['auth'])->name('adicionar_base.view');

Route::get('/controle-bancos', [App\Http\Controllers\BancosController::class, 'obterBancos'])->middleware(['auth'])->name('controle_bancos.view');

Route::fallback([App\Http\Controllers\FallbackController::class, 'pageNotFound'])->middleware(['auth'])->name('fallback');