function getBase64(file, callbacksuccess, callbackerror) {
    var reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = callbacksuccess;
    reader.onerror = callbackerror;
}
function uploadPhoto64(e, inputfile, inputphoto, inputmime, pathloadimage) {
    var file = e.target.files[0];
    getBase64(file, loaded, errorfunc);
    function loaded(e) {
        var fileString = e.target.result;
        var part_one = fileString.split("data:")[1];
        var type_mime = part_one.split(";base64")[0];
        var splited = fileString.split("base64,");
        $(inputphoto).val(splited[1]);
        $(inputmime).val(type_mime);
        if (pathloadimage) {
            $(pathloadimage).attr('src', fileString);
        }
    }
    function errorfunc(e) {
        console.log("Error base64 image", e.target.error);
    }
}

function CriaLoad(texto = 'Aguarde...'){
    return Swal.fire({
        title: texto,
        html: `<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>`,
        showCancelButton: false,
        showConfirmButton: false,
        allowOutsideClick: false
    });
}
function ExibeMensagemErroAPI(err){
    let erro = err.responseJSON;
    let message = "";
    let htmlerro = '';
    if (typeof erro != "undefined" && erro !== null) {
        message = erro.mensagem;
        $.each(erro.mensagenserro, function (i, e) {
            htmlerro += `
        <div class="alert text-danger" role="alert" style="background-color: rgba(255, 0, 0, 0.3);">
            ${e}
        </div>`;
        });
    } else {
        message = 'Ocorreu um problema inesperado.';
    }
    Swal.fire({
        title: message,
        html: htmlerro,
        icon: 'error',
        confirmButtonText: 'OK'
    });
}
$(document).ready(function () {
    if ($(window).width() <= 768) {
        $(".page-wrapper").removeClass("toggled");
    }
    $('.select2').select2();
    $(".datepicker").datepicker({
        dateFormat: 'dd/mm/yy',
        showOtherMonths: true,
        selectOtherMonths: true,
        dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado', 'Domingo'],
        dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
        dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
        monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez']
    });
    function SetaCronometro(campo, valor) {
        if (valor.toString().length == 1) {
            valor = "0" + valor;
        }
        $('#' + campo).html(valor);
    }
    function CalcularNovoCronometro(campo) {
        subtrai1 = false;
        $segundo = parseInt($("#" + campo).html());
        $segundo -= 1;
        if ($segundo < 0) {
            $segundo = 59;
            subtrai1 = true;
        }
        SetaCronometro(campo, $segundo);
        return subtrai1;
    }
    if ($('.contegam-regressiva').length > 0) {
        setInterval(function () {
            if (CalcularNovoCronometro('qtd-segundos')) {
                if (CalcularNovoCronometro('qtd-minutos')) {
                    if (CalcularNovoCronometro('qtd-horas')) { }
                }
            }
        }, 1000);
    }

    if ($('.date-mask').length) {
        $('.date-mask').each(function () {
            $(this).mask("00/00/0000");
        });
    }

    // $('.btn-photo').on('click', function() {
    //     $('#file-photo').trigger('click');
    // });

    $('.groupFilePhoto').each(function () {
        var elementCentral = $(this);
        elementCentral.find('.btn-photo').on('click', function () {
            elementCentral.find('.file-photo').trigger('click');
        });

        elementCentral.find('.file-photo').on('change', function (event) {
            var filePhoto = elementCentral.find('.file-photo');
            var pathPhoto = elementCentral.find('.path-photo');
            var typePhoto = elementCentral.find('.type-photo');
            var boxPhoto = elementCentral.find('.box-photo');

            uploadPhoto64(event, filePhoto, pathPhoto, typePhoto, boxPhoto);
        });
    });

    // $('#file-photo').on('change', function(event) {
    //     uploadPhoto64(event, '#file-photo', '#path-photo', '#type-photo', '.box-photo');
    // });

    $(".sidebar-dropdown > a").click(function () {
        $(".sidebar-submenu").slideUp(200);
        if (
            $(this)
                .parent()
                .hasClass("active")
        ) {
            $(".sidebar-dropdown").removeClass("active");
            $(this)
                .parent()
                .removeClass("active");
        } else {
            $(".sidebar-dropdown").removeClass("active");
            $(this)
                .next(".sidebar-submenu")
                .slideDown(200);
            $(this)
                .parent()
                .addClass("active");
        }
    });

    $("#close-sidebar").click(function () {
        $(".page-wrapper").removeClass("toggled");
    });

    $("#show-sidebar").click(function () {
        $(".page-wrapper").addClass("toggled");
    });

    $('form').on('submit', function (e) {
        var form = $(this);
        if (form.attr('no-process') !== undefined) {
            return true;
        }
        e.preventDefault();
        var data = $(this).serialize();
        var Authorization = "";
        if (form.attr('data-Authorization') !== undefined) {
            Authorization = form.attr('data-Authorization');
        }
        var load = CriaLoad();
        $.ajax({
            url: $(this).attr('action'),
            data: data,
            dataType: 'JSON',
            type: form.attr('method'),
            headers: {
                'Authorization': Authorization
            },
            success: function (result) {
                load.close();
                Swal.fire({
                    title: 'Sucesso:',
                    text: result.mensagem,
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((data) => {
                    if (form.attr('data-back') !== undefined) {
                        window.location = document.referrer;
                    } else {
                        if (form.attr("data-reload") !== undefined) {
                            window.location.reload();
                        } else {
                            if (form.attr("data-redirect") != undefined) {
                                window.location = form.data('link');
                            }
                        }
                    }
                });
            },
            error: function (err, resp, text) {
                load.close();
                ExibeMensagemErroAPI(err);
            }
        });
    });
});