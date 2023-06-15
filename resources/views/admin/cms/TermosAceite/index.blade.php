@extends('admin.includes.BaseseViews.index', 
[
'titulo' => 'Termos Aceite',
'urlNovo' => route('admin:termos-aceite.novo'),
'urlEditar' => route('admin:termos-aceite.edita', ''),
'urlDeletar' => route('termos-aceite.api.deleta', ''),
'urlRestaurar' => route('termos-aceite.api.restaura', ''),
'menuativo' => 'menu-cms',
'ItensHeader' => 
    [
        [
            'nome' => "Nome",
            'index' => 'nome'
        ],
        [
            'nome' => 'Slug',
            'index' => 'slug'
        ]
    ]
])