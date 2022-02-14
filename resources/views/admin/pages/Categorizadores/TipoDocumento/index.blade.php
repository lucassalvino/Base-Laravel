@extends('admin.includes.BaseseViews.index', 
[
'titulo' => 'Tipo Documento',
'urlNovo' => route('admin:tipodocumento.novo'),
'urlEditar' => route('admin:tipodocumento.edita', ''),
'urlDeletar' => route('tipodocumento.api.deleta', ''),
'urlRestaurar' => route('tipodocumento.api.restaura', ''),
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