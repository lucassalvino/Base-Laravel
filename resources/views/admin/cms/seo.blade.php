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
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="d-flex justify-content-center">
                            <div class="form-group groupFilePhoto">
                                <label class="">Imagem compartilhamento</label>
                                <img class="box-photo btn-photo img-fluid d-none d-md-block mb-2" src="{{is_null($seo) ? asset('assets/img/admin/camera.svg') : $seo->img_compartilhamento }}" width="168" height="168"> 
                                <input type="file" class="d-md-none mb-md-0 mb-3 file-photo" accept="image/*">
                                <input type="hidden" name="base_img_compartilhamento" class="path-photo">
                                <input type="hidden" name="tipo_img_compartilhamento" class="type-photo">
                                <label class="btn-photo d-none d-md-block">
                                    <i class="fas fa-file-upload"></i> Upload da imagem
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="d-flex justify-content-center">
                            <div class="form-group groupFilePhoto">
                                <label class="">Imagem FavIcon</label>
                                <img class="box-photo btn-photo img-fluid d-none d-md-block mb-2" src="{{is_null($seo) ? asset('assets/img/admin/camera.svg') : $seo->img_favicon }}" width="168" height="168"> 
                                <input type="file" class="d-md-none mb-md-0 mb-3 file-photo" accept="image/*">
                                <input type="hidden" name="base_img_favicon" class="path-photo">
                                <input type="hidden" name="tipo_img_favicon" class="type-photo">
                                <label class="btn-photo d-none d-md-block">
                                    <i class="fas fa-file-upload"></i> Upload da imagem
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="titulo">Título *</label>
                            <input value="{{is_null($seo)?'':$seo->titulo}}" type="text" name="titulo" class="form-control"  id="titulo" placeholder="Título do site" required maxlength="120">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="url">Endereço do site*</label>
                            <input type="url" value="{{is_null($seo) ? '': $seo->url}}" name="url" class="form-control"  id="url" placeholder="Endereço do site" required maxlength="255">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="descricao">Descrição *</label>
                            <input type="text"  value="{{is_null($seo)?'':$seo->descricao}}"  name="descricao" class="form-control"  id="descricao" placeholder="Descrição do site" required maxlength="500">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="palavras_chave">Palavras Chave*</label>
                            <input type="text" value="{{is_null($seo)?'':$seo->palavras_chave}}"  name="palavras_chave" class="form-control"  id="palavras_chave" placeholder="Palavras chave (separe por virgula)" required maxlength="500">
                        </div>
                    </div>
                </div>
                @php
                    $social =[];
                    if(!is_null($seo->social_links)){
                        $social = json_decode($seo->social_links, true);
                    }
                @endphp
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Link Twitter</label>
                            <input type="url" value="{{$social['twitter'] ?? ""}}"  name="social_links[twitter]" class="form-control" placeholder="Link Twitter" maxlength="300">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Link Facebook</label>
                            <input type="url" value="{{$social['facebook'] ?? ""}}"  name="social_links[facebook]" class="form-control" placeholder="Link Facebook" maxlength="300">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Link Linkdin</label>
                            <input type="url" value="{{$social['linkdin'] ?? ""}}"  name="social_links[linkdin]" class="form-control" placeholder="Link Linkdin" maxlength="300">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Link Instagram</label>
                            <input type="url" value="{{$social['instagram'] ?? ""}}"  name="social_links[instagram]" class="form-control" placeholder="Link Instagram" maxlength="300">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="script_tracking">Script de Tracking</label>
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
    $("#menu-cms").addClass('active');
    $("#menu-cms > .sidebar-submenu").show();
</script>
@stop