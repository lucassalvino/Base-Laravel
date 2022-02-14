<?php

namespace App\Http\Controllers\Web\Produtos;

use App\Http\Controllers\Web\BaseWebController;
use App\Models\Produto;

class InfoprodutoController extends BaseWebController{
    public function __construct(){
        parent::__construct(Produto::class, 
            'produtos.infoprodutos.index',
            'produtos.infoprodutos.novo',
            'produtos.infoprodutos.edita',
        );
    }
}