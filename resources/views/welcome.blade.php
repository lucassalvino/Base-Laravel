@extends('layouts.publico')


@section('content')
    <div class="container-fluid d-flex justify-content-center mt-5">
        <form class="" id="form" method="POST" 
        action="{{route('consulta.filme.api')}}" enctype="multipart/form-data" 
        data-onsubmit data-Authorization="{{session('Authorization','')}}">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <label for="titulo">Título do Filme:</label>
                    <input type="text" name="titulo" required class="form-control">
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-12">
                    <label for="titulo">Ano do Filme:</label>
                    <input type="number" name="ano" placeholder="Não é obrigatório" class="form-control">
                </div>
            </div>
            <button class="btn btn-primary mt-2" type="submit"> Buscar</button>
        </form>
    </div>
<script>
function MostrarErro(RetornoErroAPI){
    console.log("Atividade realizada com erros");
    console.log(RetornoErroAPI);

    let mensagemErroText = '';
    
    $.each(RetornoErroAPI.responseJSON.mensagenserro, function(i, item){
        mensagemErroText += '<p>'+item+'</p>'
    });
    Swal.fire({
        title: 'Error!'
        , html: mensagemErroText
        , icon: 'error'
        , confirmButtonText: 'OK'
    })
}
$('#form').on('submit', function(e){
        var form = $(this);
        e.preventDefault();
        var data = $(this).serialize();
        var Authorization = "";
        if( form.attr('data-Authorization') !== undefined ){
            Authorization = form.attr('data-Authorization');
        }

        $.ajax({
            url: $(this).attr('action'),
            data: data,
            dataType: 'JSON',
            type: form.attr('method'),
            headers:{
              'Authorization':Authorization
            },
            success: function(result){
                console.log(result.Search)
                var searchArray = JSON.stringify(result.Search);

                var encodedSearchArray = encodeURIComponent(searchArray);

                window.location.href = "{{route('consulta-filme','')}}?search=" + encodedSearchArray;           
            },
            error: function(err, resp, text) {
                
                MostrarErro(err);
            }
        });
    });
</script>
@stop