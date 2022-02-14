<?php
    if(!isset($itemTipo))
        $itemTipo = "item";
?>

<script>
    $(document).ready(function() {
        $('.delete').on('click', function(e) {
            e.preventDefault();
            id = $(this).data('id');
            $('#id-deletar').data('id', id);
            urldeletar = "{{$urlDeletar}}/" + id;

            Swal.fire({
                title: 'Atenção!'
                , text: "Deseja realmente excluir este {{$itemTipo}}?"
                , icon: 'warning'
                , showCancelButton: true
                , confirmButtonText: 'Excluir {{$itemTipo}}'
                , focusConfirm: false,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: urldeletar
                        , type: "DELETE"
                        , headers: {
                            'Authorization': "{{session('Authorization','')}}"
                        }
                        , success: function(result) {
                            let retorno = result;
                            Swal.fire({
                                title: 'Sucesso!'
                                , text: `${retorno.mensagem}`
                                , icon: 'success'
                                , confirmButtonText: 'OK'
                                /*, timer: 1500*/
                            }).then(function() {
                                location.reload();
                            });
                            $("#form_equip").trigger("reset");
                            $('#id-deletar').prop("disabled", false);
                        }
                        , error: function(err, resp, text) {
                            let erro = err.responseJSON;
                            let msgs = erro.mensagenserro;
                            let lista = $("#lista")
                            lista.empty();
                            $.each(msgs, function(i, e) {
                                lista.append(`<li>${e}</li>`)
                            })
                            Swal.fire({
                                title: 'Error!'
                                , text: erro.mensagem
                                , icon: 'error'
                                , confirmButtonText: 'OK'
                            })
                            $("#card_error").fadeIn("Slow");
                            setTimeout(function() {
                                $("#card_error").fadeOut();
                            }, 5000);
                            $('#id-deletar').prop("disabled", false);
                        }
                    });
                }
            })
        });
    });

</script>

{{-- <script>
    var urldeletar = "";
    $('#id-deletar').on('click', function() {
        id = $(this).data('id');
        $(this).prop("disabled", true);
        $.ajax({
            url: urldeletar
            , type: "DELETE"
            , headers: {
                'Authorization': "{{session('Authorization','')}}"
            }
            , success: function(result) {
                let retorno = result;
                Swal.fire({
                    title: 'Sucesso!'
                    , text: `${retorno.mensagem}`
                    , icon: 'success'
                    , confirmButtonText: 'OK'
                }).then(function() {
                    location.reload();
                });
                $("#form_equip").trigger("reset");
                $('#id-deletar').prop("disabled", false);
            }
            , error: function(err, resp, text) {
                let erro = err.responseJSON;
                let msgs = erro.mensagenserro;
                let lista = $("#lista")
                lista.empty();
                $.each(msgs, function(i, e) {
                    lista.append(`<li>${e}</li>`)
                })
                Swal.fire({
                    title: 'Error!'
                    , text: erro.mensagem
                    , icon: 'error'
                    , confirmButtonText: 'OK'
                })
                $("#card_error").fadeIn("Slow");
                setTimeout(function() {
                    $("#card_error").fadeOut();
                }, 5000);
                $('#id-deletar').prop("disabled", false);
            }
        });
    });

</script> --}}