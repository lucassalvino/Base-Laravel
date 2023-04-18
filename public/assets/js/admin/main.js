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

function buscaCep() {
    if ($.trim($("input[name='endereco[cep]']").val()) != "") {
        $.getJSON("https://viacep.com.br/ws/" + $("input[name='endereco[cep]']").val().replace(".", "") + "/json/",
            function (dados) {
                if (!("erro" in dados)) {
                    $("input[name='endereco[logradouro]']").val(dados.logradouro);
                    $("input[name='endereco[bairro]']").val(dados.bairro);
                    $("input[name='endereco[cidade]']").val(dados.localidade);
                    $("input[name='endereco[estado]']").val(dados.uf);
                    $("input[name='endereco[numero]']").val('s/n');
                } else {
                }
            }
        );
    } else {
        $("input[name='endereco[cep]']").focus();
    }
}

$(document).ready(function () {
    if ($(window).width() <= 768) {
        $(".page-wrapper").removeClass("toggled");
    }

    $("input[name='endereco[cep]']").bind("blur", function (event) {
        buscaCep();
    });

    if ($('.select2').length) {
        $('.select2').select2();
    }

    if ($('.mask-cep').length) {
        $('.mask-cep').mask('00000-000');
    }

    if ($('.mask-telefone').length){
        $('.mask-telefone').mask("(00) 0000-00009");
    }

    if ($('.mask-date').length){
        $('.mask-date').mask("00/00/0000");
    }

    if ($('.mask-cpfcnpj').length) {
        var CpfCnpjMaskBehavior = function (val) {
            return val.replace(/\D/g, "").length <= 11
                ? "000.000.000-009"
                : "00.000.000/0000-00";
        },
        cpfCnpjpOptions = {
            onKeyPress: function (val, e, field, options) {
                field.mask(CpfCnpjMaskBehavior.apply({}, arguments), options);
            },
        };
        $(".mask-cpfcnpj").mask(CpfCnpjMaskBehavior, cpfCnpjpOptions);
    }

    //https://xdsoft.net/jqplugins/datetimepicker/
    $.datetimepicker.setLocale('pt-BR');
    $(".datetimepicker").datetimepicker({
       format: 'd/m/Y H:i'
    });
    $(".datetimepicker").mask("00/00/0000 00:00");
    
    if($(".mask-money").length){
        $.each($(".mask-money"), function (i, o) {
            var prefix = 'R$ ';
            var suffix = '';
            var precision = '';
            var permitirNegativo = false;
            if ($(this).attr("data-mask-money-prefix") != undefined && $(this).attr("data-mask-money-prefix") != '') {
                prefix = $(this).attr("data-mask-money-prefix");
            }

            if ($(this).attr("data-mask-money-suffix") != undefined && $(this).attr("data-mask-money-suffix") != '') {
                suffix = $(this).attr("data-mask-money-suffix");
            }

            if($(this).attr("data-mask-money-negative") != undefined && $(this).attr("data-mask-money-negative") != ''){
                permitirNegativo = true;
            }

            $(this).maskMoney({ prefix: prefix, suffix: suffix, decimal: ",", thousands: ".", allowNegative: permitirNegativo });
        });
    }

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