@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <button type="button" id="limparcache" class="btn btn-warning">Limpar Cache</button>
        </div>
    </div>
</div>

<script>
    jQuery(function($){
        if ($("#menu-status").length) {
            $("#menu-status").addClass('active');
            $("#menu-status > .sidebar-submenu").show();
        }
        $(document).ready(function(){
            $("#limparcache").on("click", function(){
                var load = CriaLoad();
                $.ajax({
                    url: "{{route('solicita.limpeza.cache')}}",
                    dataType: 'JSON',
                    type: 'POST',
                    headers:{
                        'Authorization': "{{session('Authorization','')}}"
                    },
                    success: function(result){
                        load.close();
                        Swal.fire({
                            title: 'Sucesso:',
                            text: result.mensagem,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    },
                    error: function(err, resp, text) {
                        load.close();
                        MostrarErro(err);
                    }
                });
            });
        });
    });
</script>
@stop
