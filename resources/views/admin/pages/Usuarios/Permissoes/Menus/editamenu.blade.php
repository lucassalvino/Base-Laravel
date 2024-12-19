@extends('layouts.admin',
[
    'menuativo' => 'menu-usuarios'
])
@section('title', "Menus por grupo")

@php
    function selecionado($menuId, $menusGrupos){
        foreach ($menusGrupos as $selecionado) {
            if(strcasecmp($menuId, $selecionado->menu_id) == 0){
                return true;
            }
        }
        return false;
    }
@endphp

@section('content')
<div class="row mt-3 pt-2">
    <div class="col-12">
        <div class="d-flex w-100 align-items-center justify-content-between">
            <div class="f-flex">
                <h2>Menus no grupo <b>{{$grupo->nome}}</b></h2>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div>
                            <ul class="no-bullets">
                                @foreach ($menus as $menu)
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input input-menu" type="checkbox" value="{{$menu['id']}}" id="{{$menu['id']}}"
                                                @if (selecionado($menu['id'], $menusGrupos))
                                                    checked
                                                @endif
                                            >
                                            <label class="form-check-label" for="{{$menu['id']}}">
                                                {{$menu['nome']}}
                                            </label>
                                        </div>
                                        <ol class="no-bullets">
                                            @foreach ($menu['submenus'] as $submenu)
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input input-menu" data-parent_id="{{$menu['id']}}" type="checkbox" value="{{$submenu['id']}}" id="{{$submenu['id']}}"
                                                            @if (selecionado($submenu['id'], $menusGrupos))
                                                                checked
                                                            @endif
                                                        >
                                                        <label class="form-check-label" for="{{$submenu['id']}}">
                                                            {{$submenu['nome']}}
                                                        </label>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ol>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="d-flex w-100 justify-content-end pt-4">
                        <div class="d-flex">
                            <button type="submit" id="salvar-menus" class="btn btn-primary pl-4 pr-4"> Salvar </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function ObtemMenusSelecionados(){
    var inputs = $(".input-menu:checkbox:checked");
    var menusMarcados = [];
    for(var i = 0; i < inputs.length; i++){
        menusMarcados.push($(inputs[i]).val());
    }
    return menusMarcados;
}
$(document).ready(function(){
    $("#salvar-menus").on("click", function(){
        var grupo_id = "{{$grupo->id}}";
        var authorization = "{{session('Authorization','')}}";
        var menusAtivos = ObtemMenusSelecionados();
        $.ajax({
            url: "{{route('atualiza.menu.grupo')}}",
            data: {
                grupo_id : grupo_id,
                menus : menusAtivos
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