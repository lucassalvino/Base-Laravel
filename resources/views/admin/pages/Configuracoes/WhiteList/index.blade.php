@extends('admin.includes.BaseseViews.index', 
[
'titulo' => 'White List',
'urlNovo' => route('admin:whitelist.novo'),
'urlEditar' => route('admin:whitelist.edita', ''),
'urlDeletar' => route('whitelist.api.deleta', ''),
'urlRestaurar' => route('whitelist.api.restaura', ''),
'menuativo' => 'menu-configuracao',
'ItensHeader' => 
    [
        [
            'nome' => "Descrição",
            'index' => 'descricao'
        ],
        [
            'nome' => 'Valor',
            'index' => 'valor'
        ]
    ]
])