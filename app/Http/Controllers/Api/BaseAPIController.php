<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseAPIController extends Controller{
    protected $class = null;
    
    public function __construct($class = null) {
        $this->class = $class;
    }

    public function Cadastra(Request $request){
        if( !is_null($request->get('id')) ){
            return $this->class::AtualizaElemento($request, $request->get('id'));
        }
        return $this->class::CadastraElemento($request);
    }
    
    public function Listagem(Request $request){
        return $this->class::ListagemElemento($request);
    }

    public function Atualizar(Request $request, $id){
        return $this->class::AtualizaElemento($request, $id);
    }

    public function Deletar(Request $request, $id){
        return $this->class::DeleteElemento($request, $id);
    }
    
    public function Restore(Request $request, $id){
        return $this->class::RestoreElemento($request, $id);
    }

    public function Detalhado(Request $request, $id)
    {
        return $this->class::Detalhado($request, $id);
    }
    function Atualiza(Request $request, $id)
    {
        return $this->class::AtualizaElemento($request, $id);
    }
    function Deleta(Request $request, $id)
    {
        return $this->class::DeleteElemento($request, $id);
    }

    function Restaura(Request $request, $id)
    {
        return $this->class::RestoreElemento($request, $id);
    }

    public function ClonarRegistro(Request $request, $id){
        return $this->class::ClonaRegistro($request, $id);
    }
}