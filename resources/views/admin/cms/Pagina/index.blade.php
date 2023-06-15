@extends('admin.includes.BaseseViews.index', 
[
'titulo' => 'Páginas',
'urlNovo' => route('admin:pagina.novo'),
'urlEditar' => route('admin:pagina.edita', ''),
'urlDeletar' => route('pagina.api.deleta', ''),
'urlRestaurar' => route('pagina.api.restaura', ''),
'menuativo' => 'menu-cms',
'ItensHeader' => 
    [
        [
            'nome' => "Título",
            'index' => 'titulo'
        ],
        [
            'nome' => 'Status',
            'index' => 'status'
        ],
        [
            'nome' => 'Slug',
            'index' => 'slug'
        ]
    ]
])