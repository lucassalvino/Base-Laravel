@extends('layouts.admin')

@section('content')
<div class="d-flex w-100 flex-column">
    <div class="d-flex">
        <h3 class="text-secondary">Cadastro de Banner</h3>
    </div>
    <div class="d-flex w-100 border-top pt-3">
        <form class="w-100 formulario-padrao" action="{{route('cadastrabanner')}}" method="POST" 
            enctype="multipart/form-data" data-onsubmit data-back data-Authorization="{{session('Authorization','')}}">
            {{ csrf_field() }}
            <input type="hidden" name="id" id="id" value="{{is_null($banner)?'00000000-0000-0000-0000-000000000000':$banner->id}}">
            <div class="d-flex justify-content-between flex-wrap w-100">
                <div class="d-flex flex-column w-100 mobile-full">
                    <div class="d-flex flex-wrap w-100">
                        <div class="form-group" style="width: 60%!important">
                            <label for="titulo">Título</label>
                            <input value="{{is_null($banner)?'':$banner->titulo}}" type="text" name="titulo" class="form-control"  id="titulo" placeholder="Título do banner" maxlength="255">
                        </div>
                        <div class="form-group ml-2" style="width: 36%!important">
                            <label for="titulo">Cor Título</label>
                            <input value="{{is_null($banner)?'':$banner->cortitulo}}" type="color" name="cortitulo" class="form-control"  id="cortitulo">
                        </div>
                    </div>
                    <div class="d-flex flex-wrap w-100">
                        <div class="form-group" style="width: 60%!important">
                            <label for="subtitulo">Subtitulo</label>
                            <input type="text" value="{{is_null($banner)?'':$banner->subtitulo}}" name="subtitulo" class="form-control"  id="subtitulo" placeholder="Subtitulo" maxlength="500">
                        </div>
                        <div class="form-group ml-2" style="width: 36%!important">
                            <label for="subtitulo">Cor SubTitulo</label>
                            <input type="color" value="{{is_null($banner)?'':$banner->corsubtitulo}}" name="corsubtitulo" class="form-control"  id="corsubtitulo">
                        </div>
                    </div>
                    <div class="d-flex flex-wrap w-100">
                        <div class="form-group" style="width: 60%!important">
                            <label for="obs">Texto Obs.</label>
                            <input type="text" value="{{is_null($banner)?'':$banner->obs}}" name="obs" class="form-control"  id="obs" placeholder="Observações" maxlength="255">
                        </div>
                        <div class="form-group ml-2" style="width: 36%!important">
                            <label for="corobs">Cor Obs.</label>
                            <input type="color" value="{{is_null($banner)?'':$banner->corobs}}" name="corobs" class="form-control"  id="corobs">
                        </div>
                    </div>
                    <div class="d-flex flex-wrap w-100">
                        <div class="form-group w-100">
                            <label for="url">URL Redirecionamento</label>
                            <input type="url" value="{{is_null($banner)?'':$banner->url}}" name="url" class="form-control"  id="url" placeholder="URL Redirecionamento" maxlength="400">
                        </div>
                    </div>

                    <div class="d-flex flex-wrap w-100">
                        <div class="d-flex">
                            <div class="d-flex justify-content-center">
                                <div class="form-group groupFilePhoto">
                                    <label class="">Banner Descktop</label>
                                    <img class="box-photo btn-photo img-fluid d-none d-md-block mb-2" src="{{is_null($banner)?'https://i.ibb.co/0Vf2FK2/4781850-camera-digital-photo-photography-picture-icon-1.png':$banner->patch_descktop}}" width="168" height="168"> 
                                    <input type="file" class="d-md-none mb-md-0 mb-3 file-photo" accept="image/*">
                                    <input type="hidden" name="patch_descktop_base_64" class="path-photo">
                                    <input type="hidden" name="tipo_patch_descktop" class="type-photo">
                                    <label class="btn-photo d-none d-md-block">
                                        <i class="fas fa-file-upload"></i> Upload da imagem
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex ml-4">
                            <div class="d-flex justify-content-center">
                                <div class="form-group groupFilePhoto">
                                    <label class="">Banner Mobile</label>
                                    <img class="box-photo btn-photo img-fluid d-none d-md-block mb-2" src="{{is_null($banner)?'https://i.ibb.co/0Vf2FK2/4781850-camera-digital-photo-photography-picture-icon-1.png':$banner->patch_mobile}}" width="168" height="168"> 
                                    <input type="file" class="d-md-none mb-md-0 mb-3 file-photo" accept="image/*">
                                    <input type="hidden" name="patch_mobile_base_64" class="path-photo">
                                    <input type="hidden" name="tipo_patch_mobile" class="type-photo">
                                    <label class="btn-photo d-none d-md-block">
                                        <i class="fas fa-file-upload"></i> Upload da imagem
                                    </label>
                                </div>
                            </div>
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