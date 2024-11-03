<?php

use App\Http\Controllers\Web\Painel\PainelController;
use Illuminate\Support\Facades\Route;


if(!function_exists('ConstruiRotaPadraoPainel')){
    function ConstruiRotaPadraoPainel($nome, $controller, $pagesAuxiliares = array()){
        Route::group(['prefix' => $nome], function()use($nome, $controller, $pagesAuxiliares){
            Route::get('/', [$controller, 'Index'])->name($nome.'.index');
            Route::get('/novo', [$controller, 'Novo'])->name($nome.'.novo');
            Route::get('/editar/{id}', [$controller, 'Edita'])->name($nome.'.edita');
            if($pagesAuxiliares && is_callable($pagesAuxiliares)) {
                $pagesAuxiliares();
            }
        });
    }
}

Route::group(['as' => 'painel:'], function(){
    Route::middleware(['cors', 'VerificaSessaoWeb'])->group(function(){
        Route::get('/', [PainelController::class, 'Home'])->name('home.painel');
    });
});