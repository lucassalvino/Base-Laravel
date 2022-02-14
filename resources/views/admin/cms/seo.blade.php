@extends('layouts.admin')

@section('content')
<div class="d-flex w-100 flex-column">
    <div class="d-flex">
        <h3 class="text-secondary">Gerência de SEO</h3>
    </div>
    <div class="d-flex w-100 border-top pt-3">
        <form class="w-100 formulario-padrao" action="{{route('cadastraseo')}}" method="POST" 
            enctype="multipart/form-data" data-onsubmit data-reload data-Authorization="{{session('Authorization','')}}">
            {{ csrf_field() }}
            <div class="d-flex justify-content-between flex-wrap w-100">
                <div class="d-flex flex-column w-100 mobile-full">
                    <div class="d-flex flex-wrap w-100">
                        <div class="form-group w-48">
                            <label for="titulo">Título *</label>
                            <input value="{{is_null($seo)?'':$seo->titulo}}" type="text" name="titulo" class="form-control"  id="titulo" placeholder="Título do site" required maxlength="120">
                        </div>
                        <div class="form-group w-48 ml-2">
                            <label for="url">Endereço do site*</label>
                            <input type="url" value="{{is_null($seo)?'':$seo->url}}" name="url" class="form-control"  id="url" placeholder="Endereço do site" required maxlength="255">
                        </div>
                    </div>

                    <div class="d-flex flex-wrap w-100">
                        <div class="form-group w-48">
                            <label for="descricao">Descrição *</label>
                            <input type="text"  value="{{is_null($seo)?'':$seo->descricao}}"  name="descricao" class="form-control"  id="descricao" placeholder="Descrição do site" required maxlength="500">
                        </div>
                        <div class="form-group w-48 ml-2">
                            <label for="palavras_chave">Palavras Chave*</label>
                            <input type="text" value="{{is_null($seo)?'':$seo->palavras_chave}}"  name="palavras_chave" class="form-control"  id="palavras_chave" placeholder="Palavras chave (separe por virgula)" required maxlength="500">
                        </div>
                    </div>
                    <div class="d-flex flex-wrap w-100">
                        <div class="form-group w-100 mr-2">
                            <label for="script_tracking">Script de Tracking *</label>
                            <textarea class="form-control" id="script_tracking" name="script_tracking" rows="6" placeholder="Digite o scritp que será inserido no header. Insira inclusive a tag <script>">{{is_null($seo)?'':$seo->script_tracking}}</textarea>
                        </div>
                    </div>  
                </div>
            </div>

            <div class="d-flex w-100 justify-content-end pt-4">
                <div class="d-flex">
                    <button type="submit" class="btn btn-primary pl-4 pr-4"> Salvar </button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $("#seo-menu").addClass('active');
</script>
@stop