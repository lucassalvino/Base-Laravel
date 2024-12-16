@extends('admin.includes.BaseseViews.index',
[
'titulo' => 'Menus por Grupo',
'urlNovo' => '',
'urlEditar' => route('admin:grupo.menu.edicao', ''),
'urlDeletar' => '',
'urlRestaurar' => '',
'menuativo' => 'menu-usuarios',
'mostrarBtnCadastrar' => false,
'mostrarExclusao' => false,
'ItensHeader' =>
    [
        [
            'nome' => "Grupo",
            'index' => 'nome'
        ]
    ]
])
