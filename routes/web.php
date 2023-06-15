<?php

use App\Http\Controllers\BuscasController;
use App\Http\Controllers\Api\UsuarioController;
use App\Http\Controllers\Web\admin\ChamadaJobsController;
use App\Http\Controllers\Web\admin\Configuracoes\ConfiguracoesSistemaController;
use App\Http\Controllers\Web\admin\Configuracoes\TaxasUsuarioController;
use App\Http\Controllers\Web\admin\Configuracoes\TokenApiController;
use App\Http\Controllers\Web\admin\DashBoardController;
use App\Http\Controllers\Web\admin\LoginController as LoginControllerAdmin;
use App\Http\Controllers\Web\admin\MonitoramentoController;
use App\Http\Controllers\Web\admin\PaginaAdminController;
use App\Http\Controllers\Web\admin\TermosAceiteController;
use App\Http\Controllers\Web\admin\Usuarios\GrupoController;
use App\Http\Controllers\Web\admin\Usuarios\PermissaoController;
use App\Http\Controllers\Web\admin\Usuarios\UsuarioController as UsuarioAdminController;
use App\Http\Controllers\Web\CMS\CMSController;
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
if(!function_exists('ConstruiRotaPadraoAdmin')){
    function ConstruiRotaPadraoAdmin($nome, $controller){
        Route::group(['prefix' => $nome], function()use($nome, $controller){
            Route::get('/', [$controller, 'Index'])->name($nome.'.index');
            Route::get('/novo', [$controller, 'Novo'])->name($nome.'.novo');
            Route::get('/edit/{id}', [$controller, 'Edita'])->name($nome.'.edita');
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

Route::group(['prefix' => '/admin', 'as' => 'admin:'], function(){
    Route::prefix('/login')->group(function(){
        Route::get('/', [LoginControllerAdmin::class, 'login'])->name('login');
        Route::post('/', [LoginControllerAdmin::class, 'RealizarLogin'])->name('realizar.login');
        Route::get('/logout', [LoginControllerAdmin::class, 'RealizarLogout'])->name('realizar.logout');
    });

    Route::get('/construindo', [DashBoardController::class, 'EmConstrucao'])->name('construindo');

    Route::group(['middleware' => 'VerificaSessaoWebAdmin'], function(){
        Route::get('/', [DashBoardController::class, 'Index'])->name("home");
        ConstruiRotaPadraoAdmin('usuario', UsuarioAdminController::class);
        ConstruiRotaPadraoAdmin('grupousuarios', GrupoController::class);
        ConstruiRotaPadraoAdmin('pagina', PaginaAdminController::class);
        ConstruiRotaPadraoAdmin('termos-aceite', TermosAceiteController::class);

        Route::prefix('/configuracoes')->group(function(){
            ConstruiRotaPadraoAdmin('taxasusuario', TaxasUsuarioController::class );
            ConstruiRotaPadraoAdmin('tokenapi', TokenApiController::class);
            Route::get('/sistema', [ConfiguracoesSistemaController::class, 'Index'])->name('Index.configuracao');
        });

        Route::group(['prefix' => '/permissoes'], function(){
            Route::get('/grupopermissoes', [PermissaoController::class, 'Index'])->name('grupo.permissoes');
            Route::get('/usuariogrupo/{id}', [PermissaoController::class, 'UsuariosGrupo'])->name('grupo.usuarios');
        });

        Route::prefix('/cms')->group(function(){
            Route::get('/seo', [CMSController::class, 'seo'])->name("home.seo");
            Route::get('/banner', [CMSController::class, 'banner'])->name('cms.banner');
            Route::get('/banner/{id}', [CMSController::class, 'cadastrarbanner'])->name('cms.cadastrabanner');
        });

        Route::prefix('/monitoramento')->group(function(){
            Route::get('/cache', [MonitoramentoController::class, 'Cache'])->name('monitora-cache');
            Route::get('/chamadajobs', [ChamadaJobsController::class, 'ChamadaJobs'])->name('chamada-jobs');
        });
    });
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
    });
    
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
