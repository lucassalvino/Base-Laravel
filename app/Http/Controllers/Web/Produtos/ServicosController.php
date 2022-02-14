<?php

namespace App\Http\Controllers\Web\Produtos;

use App\Http\Controllers\Web\BaseWebController;
use App\Models\Categorizadores\Produto\StatusProduto;
use App\Models\Categorizadores\Produto\CategoriaProduto;
use App\Models\Categorizadores\TipoCobranca;
use App\Models\Categorizadores\TipoFiliacao;
use App\Models\Categorizadores\Conteudo\TipoConteudo;
use App\Models\Produto;

class ServicosController extends BaseWebController{
    public function __construct(){
        parent::__construct(Produto::class, 
            'produtos.servicos.index',
            'produtos.servicos.novo',
            'produtos.servicos.edita',
        );
    }

    public function ObtemItensViewNovo(){
        return Array(
            'status_produto' => StatusProduto::ObtenhaRegistrosAtuais(),
            'categoria_produto' => CategoriaProduto::ObtenhaRegistrosAtuais(),
            'tipo_cobranca' => TipoCobranca::ObtenhaRegistrosAtuais(),
            'tipo_filiacao' => TipoFiliacao::ObtenhaRegistrosAtuais(),
            'tipo_conteudo' => TipoConteudo::ObtenhaRegistrosAtuais(),
        );
    }
}