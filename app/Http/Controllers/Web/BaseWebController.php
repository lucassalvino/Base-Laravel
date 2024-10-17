<?php
namespace App\Http\Controllers\Web;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class BaseWebController extends Controller{
    protected $model = null;
    protected $viewIndex = "";
    protected $viewNovo = "";
    protected $viewEdita = "";
    protected $guidempty = "00000000-0000-0000-0000-000000000000";

    public function __construct($model = null, $viewIndex = null, $viewNovo = null, $viewEdita = null) {
        $this->model = $model;
        $this->viewIndex = $viewIndex;
        $this->viewNovo = $viewNovo;
        $this->viewEdita = $viewEdita;
    }

    public function ObtemItensViewNovo(){
        return Array();
    }

    public function ObtemItensViewEdita($id){
        return $this->ObtemItensViewNovo();
    }

    public function ObtemElementoEditarVisualizar(Request $request, $id){
        $retorno = null;
        if($id != $this->guidempty)
            $retorno = $this->model::Detalhado($request, $id);
        return $retorno;
    }

    public function Index(Request $request){
        $itensIndex = $this->model::ListagemElemento($request);
        return view( $this->viewIndex, compact('itensIndex'));
    }

    public function Novo(Request $request){
        $itensView = $this->ObtemItensViewNovo();
        return view( $this->viewNovo, compact('itensView'));
    }

    public function Edita(Request $request, $id = "00000000-0000-0000-0000-000000000000"){
        $id = $request->id;
        $item = $this->ObtemElementoEditarVisualizar($request, $id);
        $itensView = $this->ObtemItensViewEdita($id);
        if(is_null($item))
            return $this->Novo($request);
        return view($this->viewEdita, compact('item', 'itensView'));
    }
}
