@php
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
    
if(!isset($acaoPosSubmit))
    $acaoPosSubmit = 'data-back';

if(!isset($menuativo))
    $menuativo = '';

if(!isset($menuexpand))
    $menuexpand = '';
@endphp

@extends('layouts.painel',
    [
        "titulo" => $titulo,
        "menuativo" => $menuativo,
        "menuexpand" => $menuexpand
    ]
)

@section('content')
<div class="container-fluid">
    <form class="w-100 formulario-padrao" action="{{$urlSubmit}}" method="{{$verboSubmissao}}"  enctype="multipart/form-data" data-onsubmit {{$acaoPosSubmit}} data-Authorization="{{session('Authorization','')}}">
        {{ csrf_field() }}
        @yield('input_form')
        @if($exibirBtnSbmit)
            <div class="row mt-4">
                <div class="col-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary pl-4 pr-4"> 
                        <i class="bi bi-floppy"></i>
                        {{ $textoBotao }}
                    </button>
                </div>
            </div>
        @endif
    </form>
</div>
@yield('after_form')
@stop