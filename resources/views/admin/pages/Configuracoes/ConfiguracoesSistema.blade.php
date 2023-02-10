<?php
$titulo = "Configuração do sistema";
$urlSubmit = route('configuracoessistema.api.cadastra');
?>

@extends('layouts.admin')
@section('title', $titulo)

@section('content')
<div class="d-flex w-100 flex-column">
    <div class="d-flex">
        <h3 class="text-secondary">{{$titulo}}</h3>
    </div>
    <div class="d-flex w-100 border-top pt-3">
        <form class="w-100 formulario-padrao" action="{{$urlSubmit}}" method="POST"
            enctype="multipart/form-data" data-onsubmit data-back data-Authorization="{{session('Authorization','')}}">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="d-flex flex-column">
                            <label for="quantidade_sessoes_permitidas">Quantidade de Sessões permitidas</label>
                            <input type="number" value="{{$configuracao?$configuracao->quantidade_sessoes_permitidas:''}}" name="quantidade_sessoes_permitidas" id="quantidade_sessoes_permitidas" class="form-control" placeholder="N de logins por usuário">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="usuario_sistema_id">Usuário responsável</label>
                            <select name="usuario_sistema_id" id="usuario_sistema_id">
                                @foreach($usuarios as $key => $value)
                                    <option value="{{$value->id}}"
                                        @if(isset($configuracao) && (strcasecmp($value->id, $configuracao->usuario_sistema_id) == 0))
                                            selected
                                        @endif
                                    >{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex w-100 justify-content-end pt-4">
                <div class="d-flex">
                    <button type="submit" class="btn btn-primary pl-4 pr-4"> Salvar </button>
                </div>
            </div>
        </form>
    </div>
</div>
@if(isset($menuativo))
<script>
    jQuery(function($){
        if ($("#{{$menuativo}}").length) {
            $("#{{$menuativo}}").addClass('active');
            $("#{{$menuativo}} > .sidebar-submenu").show();
        }
    });
</script>
@endif
@stop
