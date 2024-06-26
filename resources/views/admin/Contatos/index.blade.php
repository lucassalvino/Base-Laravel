@extends('admin.includes.BaseseViews.index', 
[
'titulo' => 'Entre em Contato',
'urlNovo' => route('admin:contatos.novo'),
'urlEditar' => route('admin:contatos.edita', ''),
'urlDeletar' => route('contatos.api.deleta', ''),
'urlRestaurar' => route('contatos.api.restaura', ''),
'menuativo' => 'menu-contatos',
'ItensHeader' => 
    [
        [
            'nome' => "Nome",
            'index' => 'nome'
        ],
        [
            'nome' => 'Email',
            'index' => 'email'
        ],
        [
          'nome' => 'Telefone',
          'index' => 'telefone'
        ],
        [
          'nome' => 'Assunto',
          'index' => 'assunto'
        ],
        [
          'nome' => 'Mensagem',
          'index' => 'mensagem'
        ]
    ]
]) 