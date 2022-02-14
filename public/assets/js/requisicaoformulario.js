jQuery(function($){
    function MostrarLoad(){
        if($('#loader-wrapper').lenght) {
            $('#loader-wrapper').removeClass('stoped');
        } else {
            $('body').append('<div id="loader-wrapper"><div id="loader"></div><div class="loader-section section-left"></div><div class="loader-section section-right"></div></div>');
        }
        console.log("Mostrando mensagem de load");
    }
    
    function PararLoad(ObjLoad){
        $('#loader-wrapper').addClass('stoped');
        console.log("Parando mensagem de load");
    }
    
    function MostrarSucesso(RetornoSucessoAPI, funcaoAceite){
        console.log("Atividade realizada com sucesso");
        console.log(RetornoSucessoAPI);
    }

    function MostrarErro(RetornoErroAPI){
        console.log("Atividade realizada com erros");
        console.log(RetornoErroAPI);

        // if(!$('#ModalMensagemErro').lenght) {
        //     $('body').append('<div class="modal fade" id="ModalMensagemErro"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h3 class="modal-title"></h3><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div><div class="modal-body"></div><div class="modal-footer"><button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button></div></div></div></div>');
        // }

        // $('#ModalMensagemErro').find('.modal-title').html(RetornoErroAPI.responseJSON.mensagem);
        
        // var mensagemErroText = '';
        // $.each(RetornoErroAPI.responseJSON.mensagenserro, function(i, item){
        //     mensagemErroText += '<p>'+item+'</p>'
        // });

        // $('#ModalMensagemErro').find('.modal-body').html(mensagemErroText);

        // var modalError = new bootstrap.Modal(document.getElementById('ModalMensagemErro'));
        // modalError.show();

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
    
    $('.formAjax').on('submit', function(e){
        var form = $(this);
        if(form.attr('no-process') !== undefined){
            return true;
        }
        e.preventDefault();
        var data = $(this).serialize();
        var Authorization = "";
        if( form.attr('data-Authorization') !== undefined ){
            Authorization = form.attr('data-Authorization');
        }
        var load = MostrarLoad();

        $.ajax({
            url: $(this).attr('action'),
            data: data,
            dataType: 'JSON',
            type: form.attr('method'),
            headers:{
              'Authorization':Authorization
            },
            success: function(result){
                PararLoad(load);
                MostrarSucesso(result);
                if( form.attr('data-back') !== undefined ){
                    window.location = document.referrer;
                }else{
                    if( form.attr("data-reload") !== undefined ){
                        window.location.reload();
                    }else{
                        if(form.attr("data-redirect") != undefined){
                            window.location = form.data('link');
                        }
                    }
                }
            },
            error: function(err, resp, text) {
                PararLoad(load);
                MostrarErro(err);
            }
        });
    });
});