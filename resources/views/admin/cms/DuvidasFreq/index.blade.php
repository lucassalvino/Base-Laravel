@extends('admin.includes.BaseseViews.index', 
[
'titulo' => 'Dúvidas Frequentes',
'urlNovo' => route('admin:duvidas-frequentes.novo'),
'urlEditar' => route('admin:duvidas-frequentes.edita', ''),
'urlDeletar' => route('duvidas-frequentes.api.deleta', ''),
'urlRestaurar' => route('duvidas-frequentes.api.restaura', ''),
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
        ]
    ]
])