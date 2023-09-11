<?php

namespace App\Http\Controllers\Web\admin\Configuracoes;

use App\Http\Controllers\Web\admin\BaseAdminController;
use App\Models\Configuracoes\TokensAPI;
use App\Servicos\LoginServico;
use Illuminate\Support\Str;

class TokenApiController extends BaseAdminController{
    public function __construct(){
        parent::__construct(TokensAPI::class, 
            'admin.pages.Configuracoes.TokenAPI.index',
            'admin.pages.Configuracoes.TokenAPI.novo',
            'admin.pages.Configuracoes.TokenAPI.edita'
        );
    }
    
    public function ObtemItensViewNovo(){
        $tokenAleatorio = hash('sha256', ((string) Str::uuid()));
        return Array(
            'tokenAleatorio' => $tokenAleatorio,
            'usuarios' => LoginServico::ObtemUsuariosAdministradores()
        );
    }
}