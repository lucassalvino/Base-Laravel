<?php

namespace App\Http\Controllers\Api\Configuracoes;

use App\Http\Controllers\Api\BaseAPIController;
use App\Models\Bases\IAPIController;
use App\Models\ConfiguracoesSistema;
use Illuminate\Http\Request;

class ConfiguracoesSistemaAPIController extends BaseAPIController implements IAPIController
{
    function __construct(){
        parent::__construct(ConfiguracoesSistema::class);
    }

    function CadastraAtualizaConfiguracao(Request $request){
        $config = ConfiguracoesSistema::query()->first(['id']);
        if($config){
            return ConfiguracoesSistema::AtualizaElemento($request, $config->id);
        }else{
            return ConfiguracoesSistema::CadastraElemento($request);
        }
    }
}
