@extends('admin.includes.BaseseViews.index', 
[
'titulo' => 'Taxas Usuários',
'urlNovo' => route('admin:taxasusuario.novo'),
'urlEditar' => route('admin:taxasusuario.edita', ''),
'urlDeletar' => route('taxasusuario.api.deleta', ''),
'urlRestaurar' => route('taxasusuario.api.restaura', ''),
'menuativo' => 'menu-configuracao',
'mostrarExclusao' => false,
'mostrarBtnCadastrar' => false,
'ItensHeader' => 
    [
        [
            'nome' => 'Produtor',
            'index' => 'nome_usuario'
        ]
    ]
])