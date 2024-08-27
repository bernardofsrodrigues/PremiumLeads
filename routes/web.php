<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\AdicionarUsuario;
use Illuminate\Support\Facades\Auth;
use App\Models\Campanhas;


Route::get('/login', [App\Http\Controllers\LoginController::class, 'login'])->name('login.view');

Route::get('/', [App\Http\Controllers\PrincipalController::class, 'index'])->middleware(['auth'])->name('principal.view');

Route::get('/sobre', [App\Http\Controllers\SobreController::class, 'index'])->middleware(['auth'])->name('sobre.view');

Route::get('/meu-perfil', [App\Http\Controllers\MeuPerfilController::class, 'index'])->middleware(['auth'])->name('meu_perfil.view');

Route::get('/suporte', [App\Http\Controllers\SuporteController::class, 'index'])->middleware(['auth'])->name('suporte.view');
Route::post('/suporte', [App\Http\Controllers\SuporteController::class, 'enviarMensagem'])->middleware(['auth'])->name('suporte.post');

Route::get('/higienizacao/{banco}/{produto}/{id}', [App\Http\Controllers\HigienizacaoController::class, 'paginaBancos'])->middleware(['auth'])->name('higienizacao.view');
Route::post('/higienizacao/{banco}/{produto}/{id}', [App\Http\Controllers\ApiController::class, 'create_campanha'])->middleware(['auth'])->name('higienizacao.view.post');

Route::get('/controle-usuarios', [App\Http\Controllers\UsuariosController::class, 'controleUsuarios'])->middleware(['auth'])->name('controle_usuarios.view');
Route::get('/alterar-situacao/{user_id}', [App\Http\Controllers\UsuariosController::class, 'alterarSituacao'])->middleware(['auth'])->name('alterar_situacao');


Route::get('/controle-bases', [App\Http\Controllers\CampanhasController::class, 'controleBases'])->middleware(['auth'])->name('controle_bases.view');
Route::get('/adicionar-base/{nome}', [App\Http\Controllers\CampanhasController::class, 'adicionarCampanha'])->middleware(['auth'])->name('adicionar_base.view');

Route::get('/controle-bancos', [App\Http\Controllers\BancosController::class, 'obterBancos'])->middleware(['auth'])->name('controle_bancos.view');
Route::post('/controle-bancos/adicionar', [App\Http\Controllers\BancosController::class, 'adicionarBanco'])->middleware(['auth'])->name('controle_bancos.adicionar');
Route::get('/controle-bancos/{banco_id}', [App\Http\Controllers\BancosController::class, 'deletarBanco'])->middleware(['auth'])->name('controle_bancos.deletar');

//listar campanhas ativas sit =1;
//rota para listar campanhas ativas, (get)  //auth com user->email
Route::get('/campanhas',[App\Http\Controllers\CampanhasRController::class, 'campanhas'])->middleware(['auth']);


// //rota que passa {cod_tabela} da campanha ativa (get)
// Route::get('/campanha/{uuid_tabela}',[App\Http\Controllers\CampanhasRController::class, 'status_campanha'])->middleware(['auth']);

//listar os clientes que estao esperando 
//retornar usuario com sit = 0 ou null
Route::get('/campanha/{tabela}/waiting',[App\Http\Controllers\CampanhasRController::class, 'campanhas_pendente'])->middleware(['auth']);


//rota de atualizar {cod_tabela, array_com_dados} (update)
Route::put('/campanha',[App\Http\Controllers\ApiController::class, 'update_cliente_tabela'])->middleware(['auth']);

Route::fallback([App\Http\Controllers\FallbackController::class, 'pageNotFound'])->middleware(['auth'])->name('fallback');