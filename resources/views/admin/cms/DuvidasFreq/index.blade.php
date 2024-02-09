@extends('admin.includes.BaseseViews.index', 
[
'titulo' => 'Dúvidas Frequentes',
'urlNovo' => route('admin:duvidas.novo'),
'urlEditar' => route('admin:duvidas.edita', ''),
'urlDeletar' => route('duvidas.api.deleta', ''),
'urlRestaurar' => route('duvidas.api.restaura', ''),
'menuativo' => 'menu-cms',
'ItensHeader' => 
    [
        [
            'nome' => "Título",
            'index' => 'titulo'
        ],
        [
            'nome' => 'Ordem',
            'index' => 'ordem'
        ],
        [
            'nome' => 'Resposta',
            'index' => 'resposta'
        ]
    ]
])