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

@extends('layouts.padrao')
@section('title', $titulo)
@section('auth', 'homologado')

@section('content')

<section class="w-100 minvhtotal">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="box bg-white">
                            <div class="row vertical-row-center">
                                <div class="col-lg-12">
                                    <p class="t-h3 bold">{{$titulo}}</p>
                                </div>
                            </div>

                            <div class="row margint50">
                                <div class="col-lg-12">
                                    <form class="w-100 formFieldNormal formValidate formAjax" action="{{$urlSubmit}}" method="{{$verboSubmissao}}" 
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop