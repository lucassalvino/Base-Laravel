<?php 
namespace App\Servicos;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoServico{
    function __construct() {
    }

    public function Cadastra(Request $request){
        return Produto::CadastraElemento($request);
    }

    public function Listagem(Request $request){
        return Produto::ListagemElemento($request);
    }

    public function Detalhado(Request $request, $id){
        return Produto::Detalhado($request, $id);
    }

    public function Atualiza(Request $request, $id){
        return Produto::AtualizaElemento($request, $id);
    }

    public function Deleta(Request $request, $id){
        return Produto::DeleteElemento($request, $id);
    }

    public function Restaura(Request $request, $id){
        return Produto::RestoreElemento($request, $id);
    }
}