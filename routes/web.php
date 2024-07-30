<?php

use App\Http\Controllers\BuscasController;
use App\Http\Controllers\Api\UsuarioController;
use App\Http\Controllers\Web\admin\PaginaAdminController;
use App\Http\Controllers\Web\ConsultaFilmeController;
use App\Http\Controllers\Web\PublicoController;
use App\Utils\Strings;
use Illuminate\Support\Facades\Route;

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
if(!function_exists('ConstruiRotaPadrao')){
    function ConstruiRotaPadrao($nome, $controller, $pagesAuxiliares = array()){
        Route::group(['prefix' => $nome], function()use($nome, $controller, $pagesAuxiliares){
            Route::get('/', [$controller, 'Index'])->name($nome.'.index');
            Route::get('/novo', [$controller, 'Novo'])->name($nome.'.novo');
            Route::get('/editar/{id}', [$controller, 'Edita'])->name($nome.'.edita');
            if($pagesAuxiliares and is_array($pagesAuxiliares)) {
                foreach($pagesAuxiliares as $pages) {
                    if($pages['needID']) {
                        Route::get('/'.Strings::slugify($pages['page']).'/{id}', [$controller, $pages['page']])->name($nome.'.'.Strings::slugify($pages['page']));
                    } else {
                        Route::get('/'.Strings::slugify($pages['page']), [$controller, $pages['page']])->name($nome.'.'.Strings::slugify($pages['page']));
                    }
                }
            }
        });
    }
}

// Área não permitida para quem está logado
Route::middleware(['cors', 'CheckDeslogado'])->group(function(){
    Route::get('/cadastre-se', function () {
        return view('cadastre-se');
    });

    Route::get('/esqueci-minha-senha', function () {
        return view('esqueci-minha-senha');
    });

    Route::get('/esqueci-minha-senha-token', function () {
        return view('esqueci-minha-senha-token');
    });
});

/* Área logada */
Route::middleware(['cors', 'VerificaSessaoWeb'])->group(function(){
});

/* Área publica */
Route::middleware(['cors'])->group(function(){
    Route::prefix('/login')->group(function(){
        Route::get('/', [PublicoController::class, 'login'])->name('site.login');
        Route::post('/', [PublicoController::class, 'RealizarLogin'])->name('fazer.login');
    });

    Route::get('/logout', [PublicoController::class, 'RealizarLogout'])->name('fazer.logout');

    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');

    Route::get('/sobre', [PublicoController::class, 'Sobre'])->name('sobre');
    Route::post('/consulta-filme', [ConsultaFilmeController::class, 'ConsultarFilme'])->name('consulta-filme');
    
    Route::get('/{slug}', [PaginaAdminController::class, 'ViewPagina'])->name('cms.view.pagina');
});


/* API CSRF */
Route::namespace('Api')->middleware(['cors'])->group(function(){
    Route::prefix('/publicoapi')->group(function(){

        Route::post('/refresh-csrf', function(){
            return response()->json([
                'csrf-token' => csrf_token()
            ]);
        })->name("refresh-csrf");

        Route::post('/check-csrf', function(){
            return response()->json([
                "ok" => "ok"
            ]);
        })->name("check-csrf");

        Route::post('/usuario',[UsuarioController::class, 'Cadastra'])->name("cadastra.usuario.csrf");
        Route::prefix("/buscas")->group(function(){
            Route::get('/usuario', [BuscasController::class, 'Usuarios'])->name("api.publica.busca.usuarios");
        });
    });
});
