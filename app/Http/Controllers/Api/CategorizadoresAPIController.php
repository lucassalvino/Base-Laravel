<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categorizadores\Produto\CategoriaProduto;
use App\Models\Categorizadores\Moeda;
use App\Models\Categorizadores\Sexo;
use App\Models\Categorizadores\Produto\StatusProduto;
use App\Models\Categorizadores\TipoCobranca;
use App\Models\Categorizadores\Conteudo\TipoConteudo;
use App\Models\Categorizadores\Especialidades;
use App\Models\Categorizadores\TipoDocumento;
use App\Models\Categorizadores\TipoFiliacao;
use App\Models\Categorizadores\Questionario\TipoPergunta;
use App\Models\Categorizadores\Produto\TipoProduto;
use App\Models\Categorizadores\Questionario\TipoQuestionario;
use Illuminate\Http\Request;

/**
 * @group Categorizadores
 *
 * Endponits destinados a obtenção dos caracterizadores
 * Caracterizadores são 'enumeradores' como sexo, tipo de documento
 */
class CategorizadoresAPIController extends Controller
{

    /**
     * Obtem Todos os sexos
     *
     * @response[
     *        {
     *           'id' : '6ab08b67-9e65-47d5-9b67-9759c428f2ba',
     *           'descricao': 'OUTRO',
     *           'slug': 'outro'
     *        }, 
     *        ...
     * ]
     */
    public function Sexo(Request $request)
    {
        return Sexo::ObtenhaRegistrosAtuais();
    }

    /**
     * Obtem Todos os tipos de documentos
     *
     * @response[
     *        {
     *           'id' : '6ab08b67-9e65-47d5-9b67-9759c428f2ba',
     *           'descricao': 'OUTRO',
     *           'slug': 'outro'
     *        }, 
     *        ...
     * ]
     */
    public function TipoDocumento(Request $request)
    {
        return TipoDocumento::ObtenhaRegistrosAtuais();
    }

    public function Especialidades(Request $request){
        return Especialidades::ObtenhaRegistrosAtuais();
    }
}
