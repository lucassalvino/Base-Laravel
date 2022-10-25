@extends('admin.includes.BaseseViews.novo',[
'urlSubmit' => route('tokenapi.api.cadastra'),
'titulo' => 'Cadastro de Token',
'menuativo' => 'menu-configuracao'
])

@section('input_form')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="d-flex flex-column">
                    <label for="usuario_id">Usuário responsável</label>
                    <select name="usuario_id" class="form-control" id="usuario_id">
                        @foreach($itensView['usuarios'] as $value)
                            <option value="{{$value->id}}"
                            @if(isset($tokenapi) && strcasecmp($tokenapi->usuario_id, $value->id) == 0)
                                selected
                            @endif
                            >{{$value->name}}</option></option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex flex-column">
                    <label for="descricao">Descrição</label>
                    <input type="text" name="descricao" id="descricao" class="form-control" placeholder="Descrição">
                </div>
            </div>
        </div>
        <div class="row pt-3">
            <div class="col-md-12">
                <div class="d-flex flex-column">
                    <label for="api_key">Api Token</label>
                    <input type="text" name="api_key" id="api_key" class="form-control" placeholder="Token" 
                        value="{{ $itensView['tokenAleatorio'] }}">
                </div>
            </div>
        </div>
    </div>
@stop