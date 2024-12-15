<?php

use App\Http\Controllers\Api\Configuracoes\ConfiguracoesSistemaAPIController;
use App\Http\Controllers\Api\Configuracoes\TaxasUsuarioController;
use App\Http\Controllers\Api\Configuracoes\WhiteListController;
use App\Http\Controllers\Api\ContatosAPIController;
use App\Http\Controllers\Api\DuvidasFrequentesApiController;
use App\Http\Controllers\BuscasController;
use App\Http\Controllers\Api\GrupoController;
use App\Http\Controllers\Api\LoginApiController;
use App\Http\Controllers\Api\MenusAPIController;
use App\Http\Controllers\Api\PaginaApiController;
use App\Http\Controllers\Api\TermosAceiteAPIController;
use App\Http\Controllers\Api\TokenApiApiController;
use App\Http\Controllers\Api\UsuarioController;
use App\Http\Controllers\Web\admin\MonitoramentoController;
use App\Http\Controllers\Web\admin\Usuarios\PermissaoController;
use App\Http\Controllers\Web\CMS\CMSController;
use App\Models\Duvidas;
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
    function ConstruiRotaPadraoApi($nome, $controller, $rotascomplementares = null){
        Route::group(['prefix' => $nome], function()use($nome, $controller, $rotascomplementares){
            Route::post('/', [$controller, 'Cadastra'])->name($nome.'.api.cadastra');
            Route::get('/', [$controller, 'Listagem'])->name($nome.'.api.listagem');
            Route::get('/{id}', [$controller, 'Detalhado'])->name($nome.'.api.detalhado');
            Route::put('/{id}', [$controller, 'Atualiza'])->name($nome.'.api.editar');
            Route::patch('/{id}', [$controller, 'AtualizaParcial'])->name($nome.'.api.editar.parcial');
            Route::delete('/{id}', [$controller, 'Deleta'])->name($nome.'.api.deleta');
            Route::post('/restore/{id}', [$controller, 'Restaura'])->name($nome.'.api.restaura');
            Route::post('/clone/{id}', [$controller, 'ClonarRegistro'])->name($nome.'.api.clone');
            if(!is_null($rotascomplementares)){
                $rotascomplementares();
            }
        });
    }
}

// rotinas publicas
Route::namespace('Api')->middleware(['cors'])->group(function(){
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
        Route::post('/alterar-senha', [LoginApiController::class, 'AlteraSenha'])->name('alterar.senha');
    });

    Route::prefix("/buscas")->group(function(){
        Route::get('/usuario', [BuscasController::class, 'Usuarios'])->name("api.busca.usuarios");
    });

    Route::group(['prefix' => 'usuariogrupo'], function(){
        Route::post('/adicionausuariogrupo', [PermissaoController::class, 'AdicionaUsuarioGrupo'])->name("adicione.usuario.grupo");
        Route::post('/removerusuariogrupo', [PermissaoController::class, 'RemoverUsuarioGrupo'])->name('remove.usuario.grupo');
    });

    Route::get('/obtem-dados-logado', [LoginApiController::class, 'ObtemDadosLogado'])->name('obtem-dados-logado');

    Route::prefix('/cms')->group(function(){
        Route::post('/seo', [CMSController::class, 'cadastraseo'])->name('cadastraseo');
        Route::post('/banners', [CMSController::class, 'cadastrabanner'])->name('cadastrabanner');
        Route::delete('/deletabanner/{id}', [CMSController::class, 'deletabanner'])->name('deletabanner');
    });

    Route::prefix('/acoes-servidor')->group(function(){
        Route::post('/limpacache', [MonitoramentoController::class, "LimpaCache"])->name('solicita.limpeza.cache');
        Route::prefix('/chamada-jobs')->group(function(){});
    });

    ConstruiRotaPadraoApi('pagina', PaginaApiController::class);
    ConstruiRotaPadraoApi('termos-aceite', TermosAceiteAPIController::class);
    ConstruiRotaPadraoApi('usuario', UsuarioController::class);
    ConstruiRotaPadraoApi('grupousuarios', GrupoController::class);
    ConstruiRotaPadraoApi('tokenapi', TokenApiApiController::class);
    ConstruiRotaPadraoApi('taxasusuario', TaxasUsuarioController::class);
    ConstruiRotaPadraoApi('whitelist', WhiteListController::class);
    ConstruiRotaPadraoApi('duvidas-frequentes', DuvidasFrequentesApiController::class);
    ConstruiRotaPadraoApi('contatos', ContatosAPIController::class);
    ConstruiRotaPadraoApi('menus', MenusAPIController::class);

    Route::prefix('/configuracoessistema')->group(function(){
        Route::post('/cadastra', [ConfiguracoesSistemaAPIController::class, "CadastraAtualizaConfiguracao"])->name('configuracoessistema.api.cadastra');
    });
});
