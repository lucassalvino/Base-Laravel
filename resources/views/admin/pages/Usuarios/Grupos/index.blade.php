@extends('admin.includes.BaseseViews.index', 
[
'titulo' => 'Grupo de Usuários',
'urlNovo' => route('admin:grupousuarios.novo'),
'urlEditar' => route('admin:grupousuarios.edita', ''),
'urlDeletar' => route('grupousuarios.api.deleta', ''),
'urlRestaurar' => route('grupousuarios.api.restaura', ''),
'menuativo' => 'menu-usuarios',
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