<?php
if(!isset($titulo))
    $titulo = "Titulo";

if(!isset($itemTipo))
    $itemTipo = "item";

if(!isset($itemTipos))
    $itemTipos = "item";

if(!isset($urlNovo))
    $urlNovo = "#";

if(!isset($urlEditar))
    $urlEditar = $urlNovo;

if(!isset($urlDeletar))
    $urlDeletar = "#";

if(!isset($urlRestaurar))
    $urlRestaurar = "#";

if(!isset($ItensHeader))
    $ItensHeader = [];

if(!isset($mostrarEdicao))
    $mostrarEdicao = true;

if(!isset($mostrarExclusao))
    $mostrarExclusao = true;
?>

@extends('layouts.padrao')
@section('title', $titulo)
@section('auth', 'homologado')

@section('content')

<section class="w-100 minvhtotal">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                @if(isset($ItensMenu))
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-menu-btn">
                                @foreach($ItensMenu as $item)
                                    <li @if($item['active']) class="active" @endif><a href="{{$item['link']}}">{{$item['titulo']}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <div class="row margint30">
                    <div class="col-lg-12">
                        <div class="box bg-white">
                            <div class="row vertical-row-center">
                                <div class="col-lg-6">
                                    <p class="t-h3 bold">{{$titulo}}</p>
                                </div>

                                <div class="col-lg-6 text-end">
                                    <a href="{{$urlNovo}}" class="btn btn-icon"><ion-icon name="add-circle-outline"></ion-icon> Novo Cadastro</a>
                                </div>
                            </div>

                            <div class="row margint50">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    @foreach($ItensHeader as $item)
                                                        <th class="text-start">{{$item['nome']}}</th>
                                                    @endforeach
                                                    <th class="text-center">Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(isset($itensIndex))
                                                    @forelse($itensIndex as $item)
                                                        <tr class="vertical-center">
                                                            @foreach($ItensHeader as $chave)
                                                                <td>
                                                                    @if($chave['index'] == 'path_thumbnail')
                                                                        <img src="{{$item[$chave['index']]}}">
                                                                    @else
                                                                        {{$item[$chave['index']]}}
                                                                    @endif
                                                                </td>
                                                            @endforeach
                                                            <td align="center">
                                                                <div>
                                                                    <a href="#" data-toggle="modal" data-target=".modal_resumo" data-id="{{$item['id']}}" title="Resumo do {{$itemTipo}}" class="resumo {{isset($_GET['trashed_only'])?'':'ocultar_trash'}}">
                                                                        <div class="table-icons">
                                                                            <img src="{{asset('assets/img/icons/table/resumo.svg')}}">
                                                                            Resumo
                                                                        </div>
                                                                    </a>

                                                                    <a href="{{$urlEditar.'/'.$item['id']}}" title="Editar {{$itemTipo}}">
                                                                        <div class="table-icons">
                                                                            <img src="{{asset('assets/img/icons/table/editar.svg')}}">
                                                                            Editar
                                                                        </div>
                                                                    </a>

                                                                    <a href="#" data-id="{{$item['id']}}" title="Excluir {{$itemTipo}}" class="delete {{isset($_GET['trashed_only'])?'ocultar_trash':''}}">
                                                                        <div class="table-icons">
                                                                            <img src="{{asset('assets/img/icons/table/excluir.svg')}}">
                                                                            Excluir
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="{{count($ItensHeader)+1}}">Nenhum {{$itemTipo}} encontrado</td>
                                                        </tr>
                                                    @endforelse
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>

                                    @if(isset($itensIndex))
                                        <?php
                                            if($itensIndex->total() > 1) {
                                                $itemTipoText = $itemTipos;
                                            } else {
                                                $itemTipoText = $itemTipo;
                                            }
                                        ?>
                                        @include('includes.view_paginacao', [
                                                'currentPage' => $itensIndex->currentPage(),
                                                'lastPage' => $itensIndex->lastPage(),
                                                'total' => $itensIndex->total(),
                                                'itemTipoText' => $itemTipoText
                                            ])
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('includes.deletar')
@stop