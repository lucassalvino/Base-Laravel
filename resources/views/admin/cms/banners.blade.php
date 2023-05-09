
@extends('layouts.admin')

@section('title', "Banners")

@section('content')
<div class="d-flex w-100 flex-column">
    <div class="d-flex">
        <h2>Banners Cadastrados</h2>
    </div>
    <div class="d-flex w-100 justify-content-end">
        <a href="{{route('admin:cms.cadastrabanner', '00000000-0000-0000-0000-000000000000')}}" role="button" class="btn btn-primary">
            <i class="fas fa-pencil-alt"></i>
            Cadastrar
        </a>
    </div>
</div>
<div class="row mt-3 pt-2">
    <div class="col-12">
        <div class="card">
            <div class="card-body container-tabela">
                <div class="row table-responsive">
                    <table class="table table-borderless table-striped text-center">
                        <thead>
                            <tr>
                                <th>Titulo</th>
                                <th>URL</th>
                                <th>Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($banners as $item)
                                <tr class="text text-center">
                                    <td>{{$item->titulo}}</td>
                                    <td>{{$item->url}}</td>
                                    <td align="center">
                                        <div class="container-opcoes" data-id="{{$item->id}}">
                                            <a href="{{ route('admin:cms.cadastrabanner', $item->id)}}" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="#" data-toggle="modal" data-target=".modal_excluir" data-id="{{$item->id}}" title="Deletar o registro" class="delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">Nenhum retorno</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
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
            urldeletar = "{{route('deletabanner', '')}}/"+id
        });
    });
</script>

@yield('scripts_adicionais')

@include('admin.includes.deletar_restaurar')

@if(isset($menuativo))
    <script>
        $("#menu-cms").addClass('active');
        $("#menu-cms > .sidebar-submenu").show();
    </script>
@endif
@stop