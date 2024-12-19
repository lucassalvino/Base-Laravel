@php
    $usuario = $item['users'];
    $documento = $item['documento'][0];
    $endereco = $item['endereco'][0];
    $telefone = $item['telefone'][0];
@endphp

@extends('Painel.Templates.template-form', [
    'urlSubmit' => route('usuario.api.editar', $usuario['id']),
    'titulo' => 'Meu perfil',
    'menuativo' => 'menu-config|menu-perfil',
    'textoBotao' => 'Salvar',
    'verboSubmissao' => 'PUT',
    'acaoPosSubmit' => 'data-reload',
])

@section('input_form')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="d-flex justify-content-center">
                <div class="form-group groupFilePhoto">
                    <label class="">Seu Avatar</label>
                    <img class="box-photo btn-photo img-fluid d-none d-md-block mb-2" src="{{$usuario['path_avatar']}}" width="168" height="168"> 
                    <input type="file" class="d-md-none mb-md-0 mb-3 file-photo" accept="image/*">
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
                <div class="col-md-6 mt-3">
                    <div class="form-group">
                        <label for="email">Email:*</label>
                        <input type="email" name="email" value="{{$usuario['email']}}" class="form-control"  id="email" placeholder="Email Usuário" required maxlength="255" readonly>
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <div class="form-group">
                        <label for="senha">Sexo:*</label>
                        <select name="sexo" id="sexo" class="form-select">
                            @foreach($sexos as $key => $value)
                                <option value="{{$key}}"
                                @if( strcasecmp($key, $usuario['sexo']) == 0)
                                {{'selected' }}
                                @endif
                                > {{$value}} </option>          
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <div class="form-group">
                        <label for="nome">Nome:*</label>
                        <input type="text" name="name"  value="{{$usuario['name']}}" class="form-control" id="nome" placeholder="Nome" required>
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <div class="form-group">
                        <label for="username">Nome do usuário:*</label>
                        <input type="text" name="username" value="{{$usuario['username']}}" class="form-control" id="username" placeholder="Username" required>
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <div class="form-group">
                        <label for="documento">CPF/CNPJ:*</label>
                        <input type="text" name="documento"
                            @if(!is_null($documento['numero']))
                                value="{{$documento['numero']}}"
                                readonly 
                            @endif
                        class="mask-cpfcnpj form-control" id="documento" placeholder="CPF/CNPJ">
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <div class="form-group">
                        <label for="telefone">Telefone:*</label>
                        <input type="text" name="telefone"
                            @if(!is_null($telefone['numero']))
                                value="{{$telefone['ddd']}}{{$telefone['numero']}}"
                            @endif
                        class="mask-telefone form-control" id="telefone" placeholder="Telefone">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 mt-3">
            <div class="form-group">
                <label for="data_nascimento">Data de Nascimento:*</label>
                <input type="text" name="data_nascimento"
                    @if(!is_null($usuario['data_nascimento']))
                        value="{{date('d/m/Y', strtotime($usuario['data_nascimento']))}}"
                    @endif
                class="mask-date form-control" id="data_nascimento" placeholder="Data de nascimento">
            </div>
        </div>
        <div class="col-md-2 mt-3">
            <div class="form-group">
                <label for="cep">CEP:*</label>
                <input type="text" name="endereco[cep]"
                    @if(!is_null($endereco['cep']))
                        value="{{$endereco['cep']}}" 
                    @endif
                class="mask-cep form-control" id="cep" placeholder="CEP">
            </div>
        </div>
        <div class="col-md-6 mt-3">
            <div class="form-group">
                <label for="logradouro">Logradouro:*</label>
                <input type="text" name="endereco[logradouro]"
                    @if(!is_null($endereco['logradouro']))
                        value="{{$endereco['logradouro']}}" 
                    @endif
                class="form-control" id="logradouro" placeholder="Logradouro do endereço">
            </div>
        </div>
        <div class="col-md-2 mt-3">
            <div class="form-group">
                <label for="logradouro">Número:*</label>
                <input type="text" name="endereco[numero]"
                    @if(!is_null($endereco['numero']))
                        value="{{$endereco['numero']}}" 
                    @endif
                class="form-control" id="numero" placeholder="Número">
            </div>
        </div>
        <div class="col-md-2 mt-3">
            <div class="form-group">
                <label for="estado">UF:*</label>
                <input type="text" name="endereco[estado]"
                    @if(!is_null($endereco['estado']))
                        value="{{$endereco['estado']}}" 
                    @endif
                class="form-control" id="estado" placeholder="UF">
            </div>
        </div>
        <div class="col-md-4 mt-3">
            <div class="form-group">
                <label for="complemento">Complemento:</label>
                <input type="text" name="endereco[complemento]"
                    @if(!is_null($endereco['complemento']))
                        value="{{$endereco['complemento']}}" 
                    @endif
                class="form-control" id="complemento" placeholder="Complemento do endereço">
            </div>
        </div>
        <div class="col-md-4 mt-3">
            <div class="form-group">
                <label for="bairro">Bairro:*</label>
                <input type="text" name="endereco[bairro]"
                    @if(!is_null($endereco['bairro']))
                        value="{{$endereco['bairro']}}" 
                    @endif
                class="form-control" id="bairro" placeholder="Bairro do endereço">
            </div>
        </div>
        <div class="col-md-4 mt-3">
            <div class="form-group">
                <label for="cidade">Cidade:*</label>
                <input type="text" name="endereco[cidade]" id="cidade" class="form-control"
                    @if(!is_null($endereco['cidade']))
                        value="{{$endereco['cidade']}}" 
                    @endif
                placeholder="Cidade">
            </div>
        </div>
    </div>
</div>
@stop