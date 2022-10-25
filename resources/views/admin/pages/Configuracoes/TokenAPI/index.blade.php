@extends('admin.includes.BaseseViews.index', 
[
'titulo' => 'Tokens API',
'urlNovo' => route('admin:tokenapi.novo'),
'urlEditar' => route('admin:tokenapi.edita', ''),
'urlDeletar' => route('tokenapi.api.deleta', ''),
'urlRestaurar' => route('tokenapi.api.restaura', ''),
'menuativo' => 'menu-configuracao',
'ItensHeader' => 
    [
        [
            'nome' => "Descrição",
            'index' => 'descricao'
        ],
        [
            'nome' => 'Token',
            'index' => 'api_key'
        ]
    ]
])