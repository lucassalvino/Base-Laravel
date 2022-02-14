<div class="modal fade modal_excluir" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content" >
        <div style="display: flex; justify-content: center;padding: 20px;flex-direction: column;">
            <div style="display: flex;justify-content: center;">
                <h4 id="nome-deletar">Deseja mesmo deletar o registro?</h4>
            </div>
            <div style="display: flex;justify-content: center;">
                <button type="button" class="btn btn-primary mr-2" data-dismiss="modal">Cancelar</button>
                <button type="button" id="id-deletar" class="btn btn-secondary">Excluir</button>
            </div>
        </div>
    </div>
  </div>
</div>

<div class="modal fade modal_restaurar" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content" >
        <div style="display: flex; justify-content: center;padding: 20px;flex-direction: column;">
            <div style="display: flex;justify-content: center;">
                <h4 id="nome-restaurar">Deseja mesmo restaurar o registro?</h4>
            </div>
            <div style="display: flex;justify-content: center;">
                <button type="button" class="btn btn-primary mr-2" data-dismiss="modal">Cancelar</button>
                <button type="button" id="id-restaurar" class="btn btn-secondary">Restaurar</button>
            </div>
        </div>
    </div>
  </div>
</div>
<script>
var urldeletar = "";
var urlrestaurar = "";
$('#id-restaurar').on('click', function(){
    id = $(this).data('id');
    $(this).prop("disabled",true);
    $.ajax({
        url: urlrestaurar,
        type:"POST",
        headers:{
            'Authorization':"{{session('Authorization','')}}"
        },
        success: function(result){
            let retorno = result;
            Swal.fire({
                title: 'Sucesso!',
                text: `${retorno.mensagem}`,
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(function(){
                location.reload();
            });
            $("#form_equip").trigger("reset");
            $('#id-restaurar').prop("disabled",false);
        },
        error: function(err, resp, text) {
            let erro = err.responseJSON;
            let msgs = erro.mensagenserro;
            let lista = $("#lista")
            lista.empty();
            $.each(msgs, function(i, e){
                lista.append(`<li>${e}</li>`)
            })
            Swal.fire({
                title: 'Error!',
                text: erro.mensagem,
                icon: 'error',
                confirmButtonText: 'OK'
            })
            $("#card_error").fadeIn("Slow");
            setTimeout(function(){
                $("#card_error").fadeOut();
            }, 5000);
            $('#id-restaurar').prop("disabled",false);
        }
    });
});
$('#id-deletar').on('click', function(){
    id = $(this).data('id');
    $(this).prop("disabled",true);
    $.ajax({
        url: urldeletar,
        type: "DELETE",
        headers:{
            'Authorization':"{{session('Authorization','')}}"
        },
        success: function(result){
            let retorno = result;
            Swal.fire({
                title: 'Sucesso!',
                text: `${retorno.mensagem}`,
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(function(){
                location.reload();
            });
            $("#form_equip").trigger("reset");
            $('#id-deletar').prop("disabled",false);
        },
        error: function(err, resp, text) {
            let erro = err.responseJSON;
            let msgs = erro.mensagenserro;
            let lista = $("#lista")
            lista.empty();
            $.each(msgs, function(i, e){
                lista.append(`<li>${e}</li>`)
            })
            Swal.fire({
                title: 'Error!',
                text: erro.mensagem,
                icon: 'error',
                confirmButtonText: 'OK'
            })
            $("#card_error").fadeIn("Slow");
            setTimeout(function(){
                $("#card_error").fadeOut();
            }, 5000);
            $('#id-deletar').prop("disabled",false);
        }
    });
});
</script>