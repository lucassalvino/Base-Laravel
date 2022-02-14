<?php
if(!isset($titulo))
    $titulo = "Titulo";

if(!isset($urlSubmit))
    $urlSubmit = "#";

if(!isset($textoBotao))
    $textoBotao = "Cadastrar";

if(!isset($verboSubmissao))
    $verboSubmissao = 'POST';
 
if(!isset($exibirBtnSbmit))
    $exibirBtnSbmit = true;
?>

@extends('layouts.admin')
@section('title', $titulo)

@section('content')
<div class="d-flex w-100 flex-column">
    <div class="d-flex">
        <h3 class="text-secondary">{{$titulo}}</h3>
    </div>
    <div class="d-flex w-100 border-top pt-3">
        <form class="w-100 formulario-padrao" action="{{$urlSubmit}}" method="{{$verboSubmissao}}" 
            enctype="multipart/form-data" data-onsubmit data-back data-Authorization="{{session('Authorization','')}}">
            @yield('input_form')
            @if($exibirBtnSbmit)
                <div class="d-flex w-100 justify-content-end pt-4">
                    <div class="d-flex">
                        <button type="submit" class="btn btn-primary pl-4 pr-4"> {{ $textoBotao }} </button>
                    </div>
                </div>
            @endif
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