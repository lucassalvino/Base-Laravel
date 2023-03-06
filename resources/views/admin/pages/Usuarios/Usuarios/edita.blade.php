@extends('admin.includes.BaseseViews.novo',[
'urlSubmit' => route('usuario.api.editar', $item->id),
'titulo' => 'Edição de Usuário',
'menuativo' => 'menu-usuarios',
'textoBotao' => 'Atualizar',
'verboSubmissao' => 'PUT'
])

@section('input_form')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="d-flex justify-content-center">
                <div class="form-group groupFilePhoto">
                    <label class="">Seu Avatar</label>
                    <img class="box-photo btn-photo img-fluid d-none d-md-block mb-2" src="{{$item->path_avatar}}" width="168" height="168"> 
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
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" name="email" value="{{$item->email}}" class="form-control"  id="email" placeholder="Email Usuário" required maxlength="255">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="senha">Sexo</label>
                        <select name="sexo" id="sexo" class="select2">
                            @foreach($itensView['sexo'] as $key => $value)
                                <option value="{{$key}}"
                                @if( strcasecmp($key, $item->sexo) == 0)
                                {{'selected' }}
                                @endif
                                > {{$value}} </option>          
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" name="name"  value="{{$item->name}}" class="form-control" id="nome" placeholder="Nome" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="username">Nome do usuário</label>
                        <input type="text" name="username" value="{{$item->username}}" class="form-control" id="username" placeholder="Username" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="documento">CPF/CNPJ</label>
                        <input type="text" name="documento"
                            @if(!is_null($item['documento']))
                                value="{{$item['documento']->numero}}" 
                            @endif
                        class="mask-cpfcnpj form-control" id="documento" placeholder="CPF/CNPJ">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="senha">Senha <span style="font-size: 12px">(deixar em branco para não alterar)</span></label>
                        <input type="password" name="password" value="" class="form-control" id="senha" placeholder="senha" autocomplete="false" readonly onfocus="this.removeAttribute('readonly');">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="telefone">Telefone</label>
                <input type="text" name="telefone"
                    @if(!is_null($item['telefone']))
                        value="{{$item['telefone']->ddd}}{{$item['telefone']->numero}}"
                    @endif
                class="mask-telefone form-control" id="telefone" placeholder="Telefone">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="data_nascimento">Data de Nascimento</label>
                <input type="text" name="data_nascimento"
                    @if(!is_null($item->data_nascimento))
                        value="{{date('d/m/Y', strtotime($item->data_nascimento))}}"
                    @endif
                class="mask-date form-control" id="data_nascimento" placeholder="Data de nascimento">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="cep">CEP</label>
                <input type="text" name="endereco[cep]"
                    @if(!is_null($item['endereco']))
                        value="{{$item['endereco']->cep}}" 
                    @endif
                class="mask-cep form-control" id="cep" placeholder="CEP">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="logradouro">Logradouro</label>
                <input type="text" name="endereco[logradouro]"
                    @if(!is_null($item['endereco']))
                        value="{{$item['endereco']->logradouro}}" 
                    @endif
                class="form-control" id="logradouro" placeholder="Logradouro do endereço">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="logradouro">Número</label>
                <input type="text" name="endereco[numero]"
                    @if(!is_null($item['endereco']))
                        value="{{$item['endereco']->numero}}" 
                    @endif
                class="form-control" id="numero" placeholder="Número">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="estado">UF</label>
                <input type="text" name="endereco[estado]"
                    @if(!is_null($item['endereco']))
                        value="{{$item['endereco']->estado}}" 
                    @endif
                class="form-control" id="estado" placeholder="UF">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="complemento">Complemento</label>
                <input type="text" name="endereco[complemento]"
                    @if(!is_null($item['endereco']))
                        value="{{$item['endereco']->complemento}}" 
                    @endif
                class="form-control" id="complemento" placeholder="Complemento do endereço">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="bairro">Bairro</label>
                <input type="text" name="endereco[bairro]"
                    @if(!is_null($item['endereco']))
                        value="{{$item['endereco']->bairro}}" 
                    @endif
                class="form-control" id="bairro" placeholder="Bairro do endereço">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="cidade">Cidade</label>
                <input type="text" name="endereco[cidade]" id="cidade"
                    @if(!is_null($item['endereco']))
                        value="{{$item['endereco']->cidade}}" 
                    @endif
                placeholder="Cidade">
            </div>
        </div>
    </div>
</div>
@stop