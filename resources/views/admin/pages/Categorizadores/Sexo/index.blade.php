@extends('admin.includes.BaseseViews.index', 
[
'titulo' => 'Sexo',
'urlNovo' => route('admin:sexo.novo'),
'urlEditar' => route('admin:sexo.edita', ''),
'urlDeletar' => route('sexo.api.deleta', ''),
'urlRestaurar' => route('sexo.api.restaura', ''),
'menuativo' => 'menu-categorizadores',
'ItensHeader' => 
    [
        [
            'nome' => "Descrição",
            'index' => 'descricao'
        ],
        [
            'nome' => 'Slug',
            'index' => 'slug'
        ]
    ]
])