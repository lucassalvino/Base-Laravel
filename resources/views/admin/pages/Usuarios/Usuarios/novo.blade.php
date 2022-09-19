@extends('admin.includes.BaseseViews.novo',[
'urlSubmit' => route('usuario.api.cadastra'),
'titulo' => 'Cadastro de Usuário',
'menuativo' => 'menu-usuarios'
])

@section('input_form')
    
    <div class="d-flex justify-content-between flex-wrap w-100">
        <div class="d-flex">
            <div class="d-flex justify-content-center">
                <div class="form-group groupFilePhoto">
                    <label class="">Seu Avatar</label>
                    <img class="box-photo btn-photo img-fluid d-none d-md-block mb-2" src="{{ asset('assets/img/admin/camera.svg') }}" width="168" height="168"> 
                    <input type="file" class="d-md-none mb-md-0 mb-3 file-photo" accept="image/*" required>
                    <input type="hidden" name="avatar_base_64" class="path-photo">
                    <input type="hidden" name="tipo_imagem_avatar" class="type-photo">
                    <label class="btn-photo d-none d-md-block">
                        <i class="fas fa-file-upload"></i> Upload da imagem
                    </label>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column w-75 mobile-full">
            <div class="d-flex flex-wrap w-100">
                <div class="form-group w-48">
                    <label for="email">Email *</label>
                    <input type="email" name="email" class="form-control"  id="email" placeholder="Email Usuário" required maxlength="255">
                </div>
                <div class="w-48 form-group ml-2">
                    <label for="sexo">Sexo</label>
                    <select name="sexo" id="sexo" class="select2">
                        @foreach($itensView['sexo'] as $key => $value)
                            <option value="{{$key}}"> {{$value}} </option>          
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="d-flex flex-wrap w-100">
                <div class="w-48 form-group">
                    <label for="nome">Nome</label>
                    <input type="text" name="name" class="form-control" id="nome" placeholder="Nome" required>
                </div>
                <div class="w-48 form-group ml-2">
                    <label for="username">Nome do usuário</label>
                    <input type="text" name="username" class="form-control" id="username" placeholder="Username" required>
                </div>
            </div>
            <div class="d-flex w-100">
                <div class="w-48 mobile-full form-group">
                    <label for="senha">Senha</label>
                    <input type="password" name="password" class="form-control" id="senha" placeholder="senha" required>
                </div>
            </div>
        </div>
    </div>
@stop