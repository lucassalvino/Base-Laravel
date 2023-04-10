<?php
if(!isset($titulo))
    $titulo = "Titulo";

if(!isset($subtitulo))
    $subtitulo = $titulo;

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

if(!isset($mostrarRestauracao))
    $mostrarRestauracao = true;

if(!isset($mostrarBtnCadastrar))
    $mostrarBtnCadastrar = true;
?>

@extends('layouts.admin')

@section('title', $titulo)

@section('content')
<div class="d-flex w-100 flex-column">
    <div class="d-flex">
        <h2>{{$titulo}}</h2>
    </div>
    <div class="d-flex w-100 justify-content-end">

        @yield('acoes_adicionais')

        @if($mostrarBtnCadastrar)
            <a href="{{$urlNovo}}" role="button" class="btn btn-primary">
                <i class="fas fa-pencil-alt"></i>
                Cadastrar
            </a>
        @endif
    </div>
</div>
<div class="row mt-3 pt-2">
    <div class="col-12">
        <h5>{{isset($_GET['trashed_only'])? $subtitulo.' na lixeira': $subtitulo.' cadastrados'}}</h5>
        @include('admin.includes.viewlixeira')
        <div class="card">
            <div class="card-body container-tabela">
                <div class="row table-responsive">
                    <table class="table table-borderless table-striped text-center">
                        <thead>
                            <tr>
                                @foreach($ItensHeader as $item)
                                    <th>{{$item['nome']}}</th>
                                @endforeach
                                <th>Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($itensIndex as $item)
                                <tr class="text text-center">
                                    @foreach($ItensHeader as $chave)
                                        @if(array_key_exists('tipo', $chave))
                                            @php
                                                $vlr = $item[$chave['index']];
                                            @endphp
                                            @if($chave['tipo'] == 'bool')
                                                @php
                                                    $vlrt = "Não";
                                                    if(is_bool($vlr) && $vlr){
                                                        $vlrt = "Sim";
                                                    }elseif(!is_bool($vlr) && (
                                                        (intval($vlr) == 1) ||
                                                        (strcasecmp($vlr, "true") == 0)
                                                    )){
                                                        $vlrt = "Sim";
                                                    }
                                                @endphp
                                                <td>{{$vlrt}}</td>
                                            @elseif($chave['tipo'] == 'date' || 
                                                    $chave['tipo'] == 'datetime' || 
                                                    $chave['tipo'] == 'time')
                                                @php
                                                    $vlrt = " - ";
                                                    $formato = 'd/m/Y';
                                                    if($chave['tipo'] == 'datetime'){
                                                        $formato = 'd/m/Y H:i';
                                                    }elseif($chave['tipo'] == 'time'){
                                                        $formato = 'H:i';
                                                    }
                                                    if(array_key_exists('formato', $chave)){
                                                        $formato = $chave['formato'];
                                                    }
                                                    try{
                                                        $vlrt = date($formato, $vlr);
                                                    }catch(\Exception $erro){ 
                                                        //faz nada kkkk
                                                    }
                                                @endphp
                                                <td>{{$vlrt}}</td>
                                            @else
                                                <td>{{$item[$chave['index']]}}</td>
                                            @endif
                                        @else
                                            <td>{{$item[$chave['index']]}}</td>
                                        @endif
                                    @endforeach
                                    <td align="center">
                                        <div class="container-opcoes" data-id="{{$item['id']}}">

                                            @yield('opcoes_adicionais')

                                            @if($mostrarEdicao)
                                                <a href="{{$urlEditar.'/'.$item['id']}}" title="Editar">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @endif
                                            @if($mostrarExclusao)
                                                <a href="#" data-toggle="modal" data-target=".modal_excluir" data-id="{{$item['id']}}" title="Deletar o registro" class="delete {{isset($_GET['trashed_only'])?'ocultar_trash':''}}">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            @endif

                                            @if($mostrarRestauracao)
                                                <a href="#" data-toggle="modal" data-target=".modal_restaurar" data-id="{{$item['id']}}" title="Restaurar o registro" class="recuperar {{isset($_GET['trashed_only'])?'':'ocultar_trash'}}">
                                                    <i class="fas fa-trash-restore-alt"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{count($ItensHeader)+1}}">Nenhum retorno</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if(isset($itensIndex))
                    @include('admin.includes.view_paginacao', [
                            'currentPage' => $itensIndex->currentPage(),
                            'lastPage' => $itensIndex->lastPage(),
                            'total' => $itensIndex->total()
                        ])
                @endif
            </div>
        </div>
    </div>
</div>

@yield('modais')

<script>
    $(document).ready(function(){
        $('.delete').on('click', function(){
            id = $(this).data('id');
            $('#id-deletar').data('id', id);
            urldeletar = "{{$urlDeletar}}/"+id
        });
        $('.recuperar').on('click', function(){
            id = $(this).data('id');
            $('#id-restaurar').data('id', id);
            urlrestaurar = "{{$urlRestaurar}}/"+id
        });
    });
</script>

@yield('scripts_adicionais')

@include('admin.includes.deletar_restaurar')

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