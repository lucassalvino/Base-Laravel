<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bases\IAPIController;
use App\Models\User;
use App\Servicos\UsuarioServico;
use Illuminate\Http\Request;

class UsuarioController extends Controller implements IAPIController{
    private $servico = null;
    function __construct(){
        $this->servico = new UsuarioServico();
    }

    function Cadastra(Request $request){
        return $this->servico->CadastraUsuario($request);
    }

    function Listagem(Request $request){
        return $this->servico->Listagem($request);
    }

    public function Detalhado(Request $request, $id){
        return $this->servico->Detalhado($request, $id);
    }

    function Atualiza(Request $request, $id){
        return $this->servico->Atualiza($request, $id);
    }

    function Deleta(Request $request, $id){
        return $this->servico->Deleta($request, $id);
    }

    function Restaura(Request $request, $id){
        return $this->servico->Restaura($request, $id);
    }

    public function ClonarRegistro (Request $request, $id){
        return User::ClonaRegistro($request, $id);
    }
}
