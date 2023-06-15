@extends('admin.includes.BaseseViews.novo',[
    'urlSubmit' => route('pagina.api.editar', $item->id),
    'titulo' => 'Edição de Página',
    'menuativo' => 'menu-cms',
    'textoBotao' => 'Atualizar',
    'verboSubmissao' => 'PUT'
])

@section('input_form')
<script src="https://cdn.ckeditor.com/4.17.1/full-all/ckeditor.js"></script>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="d-flex justify-content-center">
                <div class="form-group groupFilePhoto">
                    <label class="">Thumbnail</label>
                    <img class="box-photo btn-photo img-fluid d-none d-md-block mb-2" src="{{$item->thumbnail}}" width="168" height="168"> 
                    <input type="file" class="d-md-none mb-md-0 mb-3 file-photo" accept="image/*">
                    <input type="hidden" name="thumbnail_base64" class="path-photo">
                    <input type="hidden" name="thumbnail_type" class="type-photo">
                    <label class="btn-photo d-none d-md-block">
                        <i class="fas fa-file-upload"></i> Upload da imagem
                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="titulo">Título *</label>
                        <input type="titulo" name="titulo" class="form-control"  id="titulo" placeholder="Título pagina" required maxlength="300"
                        value="{{$item->titulo}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="select2">
                            @foreach($itensView['status'] as $key => $value)
                                <option 
                                @if( strcasecmp($key, $item->status) == 0)
                                    {{'selected' }}
                                @endif
                                value="{{$key}}"> {{$value}} </option>          
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="conteudo">Conteúdo *</label>
                <input type="hidden" name="conteudo" class="form-control"  id="conteudo">
                <textarea id="conteudo_editor"></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="resumo">Resumo</label>
                <input type="hidden" name="resumo" class="form-control"  id="resumo">
                <textarea id="resumo_editor"></textarea>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        var itens = ['conteudo_editor', 'resumo_editor']
        for(var i = 0; i < itens.length; i++){
            CKEDITOR.replace( itens[i], {
                toolbar: [
                    { name: 'document', items: [ 'Source', '-', 'Save', 'NewPage', 'ExportPdf', 'Preview', 'Print', '-', 'Templates' ] },
                    { name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
                    { name: 'editing', items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
                    '/',
                    { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat' ] },
                    { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
                    { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
                    { name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
                    '/',
                    { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
                    { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
                    { name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
                    { name: 'about', items: [ 'About' ] }
                ]
            } );
        }

        CKEDITOR.instances.conteudo_editor.on('change', function(){
            $("#conteudo").val(CKEDITOR.instances.conteudo_editor.getData());
        });
        CKEDITOR.instances.resumo_editor.on('change', function(){
            $("#resumo").val(CKEDITOR.instances.resumo_editor.getData());
        });

        @if($item->conteudo)
            var conteudo = `{!! $item->conteudo !!}`;
            CKEDITOR.instances.conteudo_editor.setData(conteudo);
            $("#conteudo").val(CKEDITOR.instances.conteudo_editor.getData());
        @endif
        @if($item->resumo)
            var resumo = `{!! $item->resumo !!}`;
            CKEDITOR.instances.resumo_editor.setData(resumo);
            $("#resumo").val(CKEDITOR.instances.resumo_editor.getData());
        @endif
    });
</script>
@stop