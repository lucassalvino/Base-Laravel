@extends('admin.includes.BaseseViews.index',
[
'titulo' => 'Usuário Por Grupo',
'urlNovo' => '',
'urlEditar' => route('admin:grupo.usuarios', ''),
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
