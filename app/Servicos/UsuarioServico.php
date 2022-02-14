<?php 
namespace App\Servicos;
use App\Models\User;
use Illuminate\Http\Request;

class UsuarioServico{
    function __construct() {
    }

    public function CadastraUsuario(Request $request){
        return User::CadastraElemento($request);
    }

    public function Atualiza(Request $request, $id){
        return User::AtualizaElemento($request, $id);
    }

    public function Listagem(Request $request){
        return User::ListagemElemento($request);
    }

    public function Detalhado(Request $request, $id){
        return User::Detalhado($request, $id);
    }

    public function Deleta(Request $request, $id){
        return User::DeleteElemento($request, $id);
    }

    public function Restaura(Request $request, $id){
        return User::RestoreElemento($request, $id);
    }
}