@extends('admin.includes.BaseseViews.novo',[
'urlSubmit' => route('whitelist.api.cadastra'),
'titulo' => 'Cadastro de Nova White List',
'menuativo' => 'menu-configuracao'
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
                            >{{$value}}</option></option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex flex-column">
                    <label for="valor">IP/domínio</label>
                    <input type="text" name="valor" id="valor" class="form-control" placeholder="IP ou Domínio">
                </div>
            </div>
        </div>
        <div class="row pt-3">
            <div class="col-md-12">
                <div class="d-flex flex-column">
                    <label for="descricao">Descrição</label>
                    <input type="text" name="descricao" id="descricao" class="form-control" placeholder="Descrição" >
                </div>
            </div>
        </div>
    </div>
@stop