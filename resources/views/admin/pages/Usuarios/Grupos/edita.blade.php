@extends('admin.includes.BaseseViews.novo',[
'urlSubmit' => route('grupousuarios.api.editar', $item->id),
'titulo' => 'Edição de Grupo de Usuário',
'menuativo' => 'menu-usuarios',
'textoBotao' => 'Atualizar',
'verboSubmissao' => 'PUT'
])

@section('input_form') 
    <div class="d-flex justify-content-between flex-wrap w-100">
        <div class="d-flex flex-column w-100">
            <div class="d-flex flex-wrap w-100">
                <div class="form-group w-100">
                    <label for="email">Nome *</label>
                    <input type="text" name="nome" class="form-control" value="{{$item->nome}}" id="nome" placeholder="Nome Grupo de Usuário" required maxlength="255">
                </div>
            </div>
        </div>
    </div>
@stop