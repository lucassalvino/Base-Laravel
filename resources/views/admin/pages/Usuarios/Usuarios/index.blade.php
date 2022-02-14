@extends('admin.includes.BaseseViews.index', 
[
'titulo' => 'Usuários',
'urlNovo' => route('admin:usuario.novo'),
'urlEditar' => route('admin:usuario.edita', ''),
'urlDeletar' => route('usuario.api.deleta', ''),
'urlRestaurar' => route('usuario.api.restaura', ''),
'menuativo' => 'menu-usuarios',
'ItensHeader' => 
    [
        [
            'nome' => "Nome",
            'index' => 'name'
        ],
        [
            'nome' => 'E-mail',
            'index' => 'email'
        ]
    ]
])