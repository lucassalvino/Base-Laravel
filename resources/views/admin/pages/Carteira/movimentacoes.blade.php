<?php
$titulo = "Movimentações usuário " . $carteira->name;
$urlEditar = '#';
$menuativo = 'menu-carteiras';
$ItensHeader = [
    [
        'nome' => 'Data',
        'index' => 'data'
    ],
    [
        'nome' => 'Tipo',
        'index' => 'tipo_movimentacao'
    ],
    [
        'nome' => 'Data Disponível',
        'index' => 'data_disponivel'
    ],
    [
        'nome' => 'Status',
        'index' => 'status'
    ],
    [
        'nome' => 'Valor Movimentação',
        'index' => 'valor_movimentacao'
    ],
    [
        'nome' => 'Saldo Anterior',
        'index' => 'saldo_antes_movimentacao'
    ],
    [
        'nome' => 'Saldo após',
        'index' => 'saldo_depois_movimentacao'
    ],
];
?>
@extends('layouts.admin')
@section('title', $titulo)

@section('content')
<div class="d-flex w-100 flex-column">
    <div class="d-flex">
        <h2>{{$titulo}}</h2>
    </div>
    <div class="d-flex w-100 justify-content-end">
    </div>
</div>

<div class="row mt-3 pt-2">
    <div class="col-12">
        <h5>Movimentações da carteira</h5>
        <div class="card" style="border:none!important;">
            <div class="card-body">
                <div class="row" style="gap: 5px;">
                    <div class="col-md-3 p-2 border">
                        <span><b>Saldo Disponível:</b> {{$carteira->saldo_disponivel}}</span>
                    </div>
                    <div class="col-md-3 p-2 border">
                        <span><b>Saldo a receber:</b> {{$carteira->saldo_a_receber}}</span>
                    </div>
                    <div class="col-md-3 p-2 border">
                        <span><b>Saldo bloqueado:</b> {{$carteira->saldo_bloqueado}}</span>
                    </div>
                </div>
            </div>
        </div>
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
                                        <td>{{$item[$chave['index']]}}</td>
                                    @endforeach
                                    <td align="center">
                                        <div class="container-opcoes" data-id="{{$item['id']}}">
                                            <a href="#" title="Ver Detalhes" class="link-transacoes">
                                                <i class="fas fa-info-circle"></i>
                                            </a>
                                            <a href="{{$urlEditar.'/'.$item['id']}}" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
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
<script>
    jQuery(function($){
        if ($("#{{$menuativo}}").length) {
            $("#{{$menuativo}}").addClass('active');
            $("#{{$menuativo}} > .sidebar-submenu").show();
        }
    });
</script>
@stop
