@extends('admin.includes.BaseseViews.novo',[
'urlSubmit' => route('usuario.api.cadastra'),
'titulo' => 'Cadastro de Usuário',
'menuativo' => 'menu-usuarios'
])

@section('input_form')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="d-flex justify-content-center">
                <div class="form-group groupFilePhoto">
                    <label class="">Seu Avatar</label>
                    <img class="box-photo btn-photo img-fluid d-none d-md-block mb-2" src="{{ asset('assets/img/admin/camera.svg') }}" width="168" height="168"> 
                    <input type="file" class="d-md-none mb-md-0 mb-3 file-photo" accept="image/*" required>
                    <input type="hidden" name="base_path_avatar" class="path-photo">
                    <input type="hidden" name="tipo_path_avatar" class="type-photo">
                    <label class="btn-photo d-none d-md-block">
                        <i class="fas fa-file-upload"></i> Upload da imagem
                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" name="email" class="form-control"  id="email" placeholder="Email Usuário" required maxlength="255">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="sexo">Sexo</label>
                        <select name="sexo" id="sexo" class="select2">
                            @foreach($itensView['sexo'] as $key => $value)
                                <option value="{{$key}}"> {{$value}} </option>          
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" name="name" class="form-control" id="nome" placeholder="Nome" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="username">Nome do usuário</label>
                        <input type="text" name="username" class="form-control" id="username" placeholder="Username" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input type="password" name="password" class="form-control" id="senha" placeholder="senha" required>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop