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
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="titulo">Título</label>
                        <input value="{{is_null($banner)?'':$banner->titulo}}" type="text" name="titulo" class="form-control"  id="titulo" placeholder="Título do banner" maxlength="255">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="titulo">Cor Título</label>
                        <input value="{{is_null($banner)?'':$banner->cortitulo}}" type="color" name="cortitulo" class="form-control"  id="cortitulo">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="subtitulo">Subtitulo</label>
                        <input type="text" value="{{is_null($banner)?'':$banner->subtitulo}}" name="subtitulo" class="form-control"  id="subtitulo" placeholder="Subtitulo" maxlength="500">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="subtitulo">Cor SubTitulo</label>
                        <input type="color" value="{{is_null($banner)?'':$banner->corsubtitulo}}" name="corsubtitulo" class="form-control"  id="corsubtitulo">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="obs">Texto Obs.</label>
                        <input type="text" value="{{is_null($banner)?'':$banner->obs}}" name="obs" class="form-control"  id="obs" placeholder="Observações" maxlength="255">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="corobs">Cor Obs.</label>
                        <input type="color" value="{{is_null($banner)?'':$banner->corobs}}" name="corobs" class="form-control"  id="corobs">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="url">URL Redirecionamento *</label>
                        <input type="url" value="{{is_null($banner)?'':$banner->url}}" name="url" class="form-control"  id="url" placeholder="URL Redirecionamento" maxlength="400" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group groupFilePhoto">
                        <label class="">Banner Desktop</label>
                        <img class="box-photo btn-photo img-fluid d-none d-md-block mb-2" src="{{is_null($banner)? asset('assets/img/admin/camera.svg'):$banner->path_desktop}}" width="168" height="168"> 
                        <input type="file" class="d-md-none mb-md-0 mb-3 file-photo" accept="image/*">
                        <input type="hidden" name="path_desktop_base_64" class="path-photo">
                        <input type="hidden" name="tipo_path_desktop" class="type-photo">
                        <label class="btn-photo d-none d-md-block">
                            <i class="fas fa-file-upload"></i> Upload da imagem
                        </label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group groupFilePhoto">
                        <label class="">Banner Mobile</label>
                        <img class="box-photo btn-photo img-fluid d-none d-md-block mb-2" src="{{is_null($banner)? asset('assets/img/admin/camera.svg'):$banner->path_mobile}}" width="168" height="168"> 
                        <input type="file" class="d-md-none mb-md-0 mb-3 file-photo" accept="image/*">
                        <input type="hidden" name="path_mobile_base_64" class="path-photo">
                        <input type="hidden" name="tipo_path_mobile" class="type-photo">
                        <label class="btn-photo d-none d-md-block">
                            <i class="fas fa-file-upload"></i> Upload da imagem
                        </label>
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