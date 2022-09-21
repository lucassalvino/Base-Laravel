<?php

use App\Http\Controllers\BuscasController;
use App\Http\Controllers\Api\GrupoController;
use App\Http\Controllers\Api\LoginApiController;
use App\Http\Controllers\Api\PadroesController;
use App\Http\Controllers\Api\UsuarioController;
use App\Http\Controllers\Web\cms\CMSController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


if(!function_exists('ConstruiRotaPadraoApi')){
    function ConstruiRotaPadraoApi($nome, $controller){
        Route::group(['prefix' => $nome], function()use($nome, $controller){
            Route::post('/', [$controller, 'Cadastra'])->name($nome.'.api.cadastra');
            Route::get('/', [$controller, 'Listagem'])->name($nome.'.api.listagem');
            Route::get('/{id}', [$controller, 'Detalhado'])->name($nome.'.api.detalhado');
            Route::put('/{id}', [$controller, 'Atualiza'])->name($nome.'.api.editar');
            Route::delete('/{id}', [$controller, 'Deleta'])->name($nome.'.api.deleta');
            Route::post('/restore/{id}', [$controller, 'Restaura'])->name($nome.'.api.restaura');
            Route::post('/clone/{id}', [$controller, 'ClonarRegistro'])->name($nome.'.api.clone');
        });
    }
}

// rotinas publicas
Route::namespace('Api')->middleware(['cors'])->group(function(){
    Route::prefix('/padroes')->group(function(){
        Route::post('/',[PadroesController::class, 'Cadastra'])->name("exemplocadastro");
        Route::get('/',[PadroesController::class, 'Listagem'])->name("exemplolistagem");
        Route::get('/{id}',[PadroesController::class, 'Detalhado'])->name("exemplodetalhado");
        Route::put('/{id}',[PadroesController::class, 'Atualiza'])->name("exemploatualiza");
        Route::delete('/{id}',[PadroesController::class, 'Deleta'])->name("exemplodeleta");
        Route::post('/restore/{id}',[PadroesController::class, 'Restaura'])->name("exemplorestaura");
    });

    Route::prefix('/login')->group(function(){
        Route::post('/resetar_senha', [LoginApiController::class, 'ResetarSenha'])->name('ResetarSenha');
        Route::post('/registra_resetar_senha', [LoginApiController::class, 'RegistraResetarSenha'])->name('RegistraResetarSenha');
        Route::post('/', [LoginApiController::class, 'RealizaLogin'])->name('RealizaLogin');
    });
});


// rotinas privadas
Route::namespace('Api')->middleware(['cors', 'VerificaSessao'])->group(function(){
    Route::prefix('/login')->group(function(){
        Route::delete('/', [LoginApiController::class, 'Logout'])->name('Logout');
    });

    Route::prefix("/buscas")->group(function(){
        Route::get('/usuario', [BuscasController::class, 'Usuarios'])->name("api.busca.usuarios");
    });

    Route::get('/obtem-dados-logado', [LoginApiController::class, 'ObtemDadosLogado'])->name('obtem-dados-logado');

    Route::prefix('/cms')->group(function(){
        Route::post('/seo', [CMSController::class, 'cadastraseo'])->name('cadastraseo');
        Route::post('/banners', [CMSController::class, 'cadastrabanner'])->name('cadastrabanner');
        Route::delete('/deletabanner/{id}', [CMSController::class, 'deletabanner'])->name('deletabanner');
    });

    ConstruiRotaPadraoApi('usuario', UsuarioController::class);
    ConstruiRotaPadraoApi('grupousuarios', GrupoController::class);
});
