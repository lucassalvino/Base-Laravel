<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\admin\TermosAceiteController;
use App\Http\Controllers\Web\admin\Usuarios\GrupoController;
use App\Http\Controllers\Web\admin\Usuarios\PermissaoController;
use App\Http\Controllers\Web\admin\Usuarios\UsuarioController as UsuarioAdminController;
use App\Http\Controllers\Web\admin\ChamadaJobsController;
use App\Http\Controllers\Web\admin\Configuracoes\ConfiguracoesSistemaController;
use App\Http\Controllers\Web\admin\Configuracoes\TaxasUsuarioController;
use App\Http\Controllers\Web\admin\Configuracoes\TokenApiController;
use App\Http\Controllers\Web\admin\Configuracoes\WhiteListController;
use App\Http\Controllers\Web\admin\ContatosAdminController;
use App\Http\Controllers\Web\admin\DashBoardController;
use App\Http\Controllers\Web\admin\DuvidasFrequentesAdminController;
use App\Http\Controllers\Web\admin\LoginController as LoginControllerAdmin;
use App\Http\Controllers\Web\admin\MonitoramentoController;
use App\Http\Controllers\Web\admin\PaginaAdminController;
use App\Http\Controllers\Web\CMS\CMSController;

if(!function_exists('ConstruiRotaPadraoAdmin')){
    function ConstruiRotaPadraoAdmin($nome, $controller){
        Route::group(['prefix' => $nome], function()use($nome, $controller){
            Route::get('/', [$controller, 'Index'])->name($nome.'.index');
            Route::get('/novo', [$controller, 'Novo'])->name($nome.'.novo');
            Route::get('/edit/{id}', [$controller, 'Edita'])->name($nome.'.edita');
        });
    }
}

Route::group(['as' => 'admin:'], function(){
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
        ConstruiRotaPadraoAdmin('duvidas-frequentes', DuvidasFrequentesAdminController::class);
        ConstruiRotaPadraoAdmin('contatos', ContatosAdminController::class);

        Route::prefix('/configuracoes')->group(function(){
            ConstruiRotaPadraoAdmin('taxasusuario', TaxasUsuarioController::class );
            ConstruiRotaPadraoAdmin('tokenapi', TokenApiController::class);
            ConstruiRotaPadraoAdmin('whitelist', WhiteListController::class);
            Route::get('/sistema', [ConfiguracoesSistemaController::class, 'Index'])->name('Index.configuracao');
        });

        Route::group(['prefix' => '/permissoes'], function(){
            Route::get('/grupopermissoes', [PermissaoController::class, 'Index'])->name('grupo.permissoes');
            Route::get('/menusgrupos', [PermissaoController::class, 'MenusGrupo'])->name('grupo.menus');
            Route::get('/usuariogrupo/{id}', [PermissaoController::class, 'UsuariosGrupo'])->name('grupo.usuarios');
            Route::get('/menugrupo/{id}', [PermissaoController::class, 'MenusGrupoEdicao'])->name('grupo.menu.edicao');
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
