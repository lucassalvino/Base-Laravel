@extends('admin.includes.BaseseViews.novo',[
    'urlSubmit' => route('termos-aceite.api.editar', $item->id),
    'titulo' => 'Edição de Termos de aceite',
    'menuativo' => 'menu-cms',
    'textoBotao' => 'Atualizar',
    'verboSubmissao' => 'PUT'
])

@section('input_form')
<script src="https://cdn.ckeditor.com/4.17.1/full-all/ckeditor.js"></script>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="nome">Nome *</label>
                <input type="text" name="nome" class="form-control" id="nome" placeholder="Nome do termo" required maxlength="300"
                value="{{$item->nome}}">
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
</div>
<script>
    $(document).ready(function(){
        var itens = ['conteudo_editor']
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
        @if($item->conteudo)
            var conteudo = `{!! $item->conteudo !!}`;
            CKEDITOR.instances.conteudo_editor.setData(conteudo);
            $("#conteudo").val(CKEDITOR.instances.conteudo_editor.getData());
        @endif
    });
</script>
@stop