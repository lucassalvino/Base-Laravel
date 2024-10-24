<?php

namespace App\Http\Controllers\Web\admin\Configuracoes;

use App\Http\Controllers\Web\admin\BaseAdminController;
use App\Models\ConfiguracoesSistema;
use App\Servicos\LoginServico;
use App\Servicos\UsuarioServico;
use Illuminate\Http\Request;

class ConfiguracoesSistemaController extends BaseAdminController{
    public function __construct(){
        parent::__construct(ConfiguracoesSistema::class
        );
    }

    public function Index(Request $request){
        $configuracao = ConfiguracoesSistema::query()->first();
        $usuarios = UsuarioServico::ObtemUsuariosGrupo(LoginServico::SlugAdmin);
        return view('admin.pages.Configuracoes.ConfiguracoesSistema', compact('configuracao', 'usuarios'));
    }
}
