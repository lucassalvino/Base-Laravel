<?php

namespace App\Http\Controllers\Web\admin\Configuracoes;

use App\Http\Controllers\Web\admin\BaseAdminController;
use App\Models\ConfiguracoesSistema;
use Illuminate\Http\Request;

class ConfiguracoesSistemaController extends BaseAdminController{
    public function __construct(){
        parent::__construct(ConfiguracoesSistema::class
        );
    }

    public function Index(Request $request){
        $configuracao = ConfiguracoesSistema::query()->first();
        return view('admin.pages.Configuracoes.ConfiguracoesSistema', compact('configuracao'));
    }
}