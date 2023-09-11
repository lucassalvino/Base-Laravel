@extends('admin.includes.BaseseViews.novo',[
'urlSubmit' => route('whitelist.api.editar', $item['id']),
'titulo' => 'Cadastro de Token',
'menuativo' => 'menu-configuracao',
'textoBotao' => 'Atualizar',
'verboSubmissao' => 'PUT'
])

@section('input_form')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="d-flex flex-column">
                    <label for="tipo">Tipo</label>
                    <select name="tipo" class="form-control" id="tipo">
                        @foreach($itensView['tipos'] as $key => $value)
                            <option value="{{$key}}"
                            @if(strcasecmp($item['tipo'], $key) == 0)
                                selected
                            @endif
                            >{{$value}}</option></option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex flex-column">
                    <label for="valor">IP/domínio</label>
                    <input type="text" name="valor" id="valor" class="form-control" placeholder="IP ou Domínio" value="{{$item['valor']}}">
                </div>
            </div>
        </div>
        <div class="row pt-3">
            <div class="col-md-12">
                <div class="d-flex flex-column">
                    <label for="descricao">Descrição</label>
                    <input type="text" name="descricao" id="descricao" class="form-control" placeholder="Descrição" value="{{$item['descricao']}}">
                </div>
            </div>
        </div>
    </div>
@stop