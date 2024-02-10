@extends('admin.includes.BaseseViews.novo',[
    'urlSubmit' => route('duvidas.api.cadastra'),
    'titulo' => 'Cadastro de Dúvidas Frequentes',
    'menuativo' => 'menu-cms'
])

@section('input_form')
<script src="https://cdn.ckeditor.com/4.17.1/full-all/ckeditor.js"></script>
<div class="container">
    <div class="row">
    <div class="col-md-3">
            <div class="form-group">
                <label for="ordem">Ordem *</label>
                <input type="number" name="ordem" class="form-control"  id="ordem" placeholder="Ordem" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="titulo">Título *</label>
                <input type="text" name="titulo" class="form-control"  id="titulo" placeholder="Dúvida" required maxlength="255">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="resposta">Resposta *</label>
                <input type="hidden" name="resposta" class="form-control"  id="resposta">
                <textarea id="resposta_editor"></textarea>
            </div>
        </div>
        
    </div>
</div>
<script>
    $(document).ready(function(){
        var itens = ['resposta_editor']
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

        CKEDITOR.instances.resposta_editor.on('change', function(){
            $("#resposta").val(CKEDITOR.instances.resposta_editor.getData());
        });
    });
</script>
@stop