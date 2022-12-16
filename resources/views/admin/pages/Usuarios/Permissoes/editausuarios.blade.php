@extends('layouts.admin')
@section('title', "Usuários por grupo")


@section('content')
<div class="row mt-3 pt-2">
    <div class="col-12">
        <div class="d-flex w-100 align-items-center justify-content-between">
            <div class="f-flex">
                <h2>Usuários no grupo {{$grupo->nome}}</h2>
            </div>
            <div class="d-flex">
                <a href="" role="button" id="adicionar_usuario" class="d-flex align-items-center btn btn-primary">
                    <i class="fas fa-user-plus mr-2"></i>
                    Adicionar Usuário
                </a>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-body container-tabela">
                <div class="row table-responsive">
                    <table class="table table-borderless table-striped text-center">
                        <thead>
                            <tr>
                                <th>Usuário</th>
                                <th>Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($usuariosGrupos as $item)
                                <tr class="text text-center">
                                    <td>
                                        {{$item->nome_usuario}}
                                    </td>
                                    <td align="center">
                                        <div class="container-opcoes" data-usuario_id="{{$item['usuario_id']}}">
                                            <a href="#" data-toggle="modal" data-id="{{$item['usuario_id']}}" title="Deletar o registro" class="delete modal_remover_usuario">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2">Nenhum retorno</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if(isset($usuariosGrupos))
                    @include('admin.includes.view_paginacao', [
                            'currentPage' => $usuariosGrupos->currentPage(),
                            'lastPage' => $usuariosGrupos->lastPage(),
                            'total' => $usuariosGrupos->total()
                        ])
                @endif
            </div>
        </div>
    </div>
</div>

<div class="modal" id="modaladicionar" role="dialog" aria-labelledby="modaladicionarTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modaladicionarTitle">Selecione o usuário</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group w-100">
            <label for="user_filtro_id">Busca:</label>
                <select class="form-control select-ajax select_2_usuario" id="user_filtro_id">
                </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="adicionar_usuario_submit">Adicionar</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
    $("#adicionar_usuario").on("click", function(event){
        event.preventDefault();
        $("#modaladicionar").modal('show');
    });
    $(".select_2_usuario").select2({
        ajax: {
            url: "{{route('api.busca.usuarios')}}",
            dataType: 'json',
            delay: 250,
            headers: {
                'Authorization': "{{session('Authorization','')}}"
            },
            data: function(params){
                return {
                    search: params.term
                };
            },
            processResults: function(data, params) {
                var ret = $.map(data, function(obj) {
                    obj.id = obj.id;
                    obj.text = obj.name;
                    return obj;
                });
                return {
                    results: ret
                };
            },
            cache: true
        },
        placeholder: 'Busca de usuários',
        minimumInputLength: 3,
            language: {
            inputTooShort: function() {
                return 'Digite pelo menos 3 letras ou números';
            },
            "noResults": function(){
                return "Nenhum resultado encontrado";
            }
        }
    });

    $("#adicionar_usuario_submit").on("click", function(){
        var usuario_id = $("#user_filtro_id").val();
        if(usuario_id == null){
            return false;
        }
        var grupo_id = "{{$grupo->id}}";
        var authorization = "{{session('Authorization','')}}";
        $.ajax({
            url: "{{route('adicione.usuario.grupo')}}",
            data: {
                usuario_id : usuario_id,
                grupo_id : grupo_id
            },
            dataType: 'JSON',
            type: 'POST',
            headers:{
              'Authorization': authorization
            },
            success: function(result){
                document.location.reload(true);
            }
        });
    });

    $(".modal_remover_usuario").on("click", function(){
        var usuario_id = $(this).data('id');
        var grupo_id = "{{$grupo->id}}";
        var authorization = "{{session('Authorization','')}}";
        $.ajax({
            url: "{{route('remove.usuario.grupo')}}",
            data: {
                usuario_id : usuario_id,
                grupo_id : grupo_id
            },
            dataType: 'JSON',
            type: 'POST',
            headers:{
              'Authorization': authorization
            },
            success: function(result){
                document.location.reload(true);
            }
        });
    });
});
</script>
@stop