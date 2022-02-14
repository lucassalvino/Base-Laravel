<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bases\IAPIController;
use App\Models\Grupo;
use Illuminate\Http\Request;

/**
 * @group Grupo de Usuários
 *
 * Endponits para gestão de grupos de usuários
 */
class GrupoController extends Controller implements IAPIController
{
    private $model = null;
    function __construct()
    {
        $this->model = new Grupo();
    }

    function Cadastra(Request $request)
    {
        return $this->model->CadastraElemento($request);
    }

    function Listagem(Request $request)
    {
        return $this->model->ListagemElemento($request);
    }

    public function Detalhado(Request $request, $id)
    {
        return $this->model->Detalhado($request, $id);
    }

    function Atualiza(Request $request, $id)
    {
        return $this->model->AtualizaElemento($request, $id);
    }

    function Deleta(Request $request, $id)
    {
        return $this->model->DeleteElemento($request, $id);
    }

    function Restaura(Request $request, $id)
    {
        return $this->model->RestoreElemento($request, $id);
    }
}
