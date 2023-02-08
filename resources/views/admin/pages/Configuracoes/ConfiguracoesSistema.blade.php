<?php
$titulo = "Configuração do sistema";
$urlSubmit = "#";
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
            @yield('input_form')
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