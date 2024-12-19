@php
if(!isset($titulo))
    $titulo = "Titulo";

if(!isset($acaoPosSubmit))
    $acaoPosSubmit = 'data-back';

if(!isset($menuativo))
    $menuativo = '';

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

if(!isset($mostrarBtnCadastrar))
    $mostrarBtnCadastrar = true;

if(!isset($subtitulo))
    $subtitulo = $titulo;

if(!isset($mostrarRestauracao))
    $mostrarRestauracao = true;

if(!isset($coluna_id))
    $coluna_id = 'id';

if(!isset($textoCadastrar)){
    $textoCadastrar = "Cadastrar";
}
if(!isset($classBtnCadastro)){
    $classBtnCadastro = "btn-primary";
}
@endphp

@extends('layouts.painel',
    [
        "titulo" => $titulo,
        "menuativo" => $menuativo
    ]
)

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-flex justify-content-end gap-3">
            @yield('acoes_adicionais')
             @if($mostrarBtnCadastrar)
                <a href="{{$urlNovo}}" role="button" class="btn {{$classBtnCadastro}}">
                    <i class="bi bi-plus-square"></i>
                    {{$textoCadastrar}}
                </a>
            @endif
        </div>
    </div>
    <div class="row mt-3">
        <h5>{{isset($_GET['trashed_only'])? $subtitulo.' na lixeira': $subtitulo.' cadastrados'}}</h5>
        @include('Painel.includes.viewlixeira')
    </div>
    <div class="row mt-3">
        <div class="col-12 d-flex table-responsive">
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
                                                $vlrt = date($formato, strtotime($vlr));
                                            }catch(\Exception $erro){ 
                                                //faz nada kkkk
                                            }
                                        @endphp
                                        <td>{{$vlrt}}</td>
                                    @elseif($chave['tipo'] == 'money')
                                        @php
                                            $prefixo = '';
                                            $valor = $item[$chave['index']];
                                            if(array_key_exists('inteiro', $chave) && $chave['inteiro']){
                                                $valor = $valor/100;
                                            }
                                            if($valor < 0){
                                                $prefixo = '-';
                                                $valor = $valor * -1;
                                            }
                                        @endphp
                                        <td>{{$prefixo}}R$ {{ number_format($valor, 2, ',','.'); }}</td>
                                    @elseif($chave['tipo'] == 'document')
                                        @php
                                            $value = $item[$chave['index']];
                                            if(App\Utils\Valida::CPF($value)){
                                                $value = App\Utils\Strings::AplicaMascara(App\Utils\Strings::SomenteNumeros($value), "###.###.###-##");
                                            }elseif(App\Utils\Valida::CNPJ($value)){
                                                $value = App\Utils\Strings::AplicaMascara(App\Utils\Strings::SomenteNumeros($value), "##.###.###/####-##");
                                            }
                                        @endphp
                                        <td>{{$value}}</td>
                                    @elseif($chave['tipo'] == 'status_pagamento')
                                        <td>
                                            <div class="alert alert-listagem alert-{{ ObtemClassCorStatusPagamento($item['status']) }} text-center" role="alert">
                                                <strong>{{ $item[$chave['index']] }}</strong>
                                            </div>
                                        </td>
                                    @else
                                        <td>{{$item[$chave['index']]}}</td>
                                    @endif
                                @else
                                    <td>{{$item[$chave['index']]}}</td>
                                @endif
                            @endforeach
                            <td align="center">
                                <div class="container-opcoes gap-2" data-id="{{$item->{$coluna_id};}}">

                                    @yield('opcoes_adicionais')

                                    @if($mostrarEdicao)
                                        <a href="{{$urlEditar. '/' . $item->{$coluna_id}; }}" title="Editar" class="edita-acao btn btn-primary">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                    @endif

                                    @if($mostrarExclusao)
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#modal_excluir" data-id="{{$item->{$coluna_id}; }}" title="Deletar o registro" class="delete btn btn-danger {{isset($_GET['trashed_only'])?'ocultar_trash':''}}">
                                            <i class="bi bi-trash3"></i>
                                        </a>
                                    @endif

                                    @if($mostrarRestauracao)
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#modal_restaurar" data-id="{{$item->{$coluna_id}; }}" title="Restaurar o registro" class="recuperar btn btn-warning {{isset($_GET['trashed_only'])?'':'ocultar_trash'}}">
                                            <i class="bi bi-recycle"></i>
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
@include('Painel.includes.deletar_restaurar')
@stop