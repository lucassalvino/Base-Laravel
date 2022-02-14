@extends('admin.includes.BaseseViews.novo',[
'urlSubmit' => route('grupousuarios.api.cadastra'),
'titulo' => 'Cadastro de Grupo de Usuário',
'menuativo' => 'menu-usuarios'
])

@section('input_form')
    
    <div class="d-flex justify-content-between flex-wrap w-100">
        <div class="d-flex flex-column w-100">
            <div class="d-flex flex-wrap w-100">
                <div class="form-group w-100">
                    <label for="email">Nome *</label>
                    <input type="text" name="nome" class="form-control" id="nome" placeholder="Nome Grupo de Usuário" required maxlength="255">
                </div>
            </div>
        </div>
    </div>
@stop