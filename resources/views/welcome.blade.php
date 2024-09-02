@extends('layouts.publico')


@section('content')
    <div class="container my-2">
        <form class="formValidate formAjax" method="POST" action="{{route('consulta-filme')}}">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <label for="titulo">Título:</label>
                    <input type="text" name="titulo" required class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="titulo">Ano do Filme:</label>
                    <input type="number" name="ano" placeholder="Não é obrigatório" class="form-control">
                </div>
            </div>
            <button class="btn btn-primary mt-2" type="submit"> Buscar</button>
        </form>
    </div>
@stop