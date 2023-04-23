<?php
namespace App\Http\Controllers\Web\admin;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class BaseAdminController extends Controller{
    protected $class = null;
    protected $viewIndex = "";
    protected $viewNovo = "";
    protected $viewEdita = "";
    protected $guidempty = "00000000-0000-0000-0000-000000000000";

    public function __construct($class = null, 
        $viewIndex = 'admin.construindo', 
        $viewNovo = 'admin.construindo', 
        $viewEdita = 'admin.construindo'  ) {
            
        $this->class = $class;
        $this->viewIndex = $viewIndex;
        $this->viewEdita = $viewEdita;
        $this->viewNovo = $viewNovo;
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
            $retorno = $this->class::Detalhado($request, $id);
        return $retorno;
    }

    public function Index(Request $request){
        $itensIndex = $this->class::ListagemElemento($request);
        return view( $this->viewIndex, compact('itensIndex'));
    }

    public function Novo(Request $request){
        $itensView = $this->ObtemItensViewNovo();
        return view( $this->viewNovo, compact('itensView'));
    }

    public function Edita(Request $request, $id = "00000000-0000-0000-0000-000000000000"){
        $item = $this->ObtemElementoEditarVisualizar($request, $id);
        $itensView = $this->ObtemItensViewEdita($id);
        if(is_null($item))
            return $this->Novo($request);
        return view($this->viewEdita, compact('item', 'itensView'));
    }
}
