@extends('layouts.padrao')
@section('title', 'Esqueci minha senha')

@section('content')

<section class="w-100 bg-logo-destak minvhtotal">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-6 col-lg-5"></div>

            <div class="col-xxl-4 col-lg-5">
                <h2 class="bold">Olá!</h2>
                <h3 class="black-light">Vamos recuperar sua senha!</h3>
            </div>
        </div>

        <div class="row justify-content-center margint30 margintm20 m-invert-column">
            <div class="col-xxl-4 col-lg-4 margintm30">
                <img src="{{asset('assets/img/logo-blue.svg')}}" class="logo-blue">
                <h1 class="t-m-h2">
                    Uma plataforma de produtores e afiliados que foi feita apenas para <span class="f-inter blue">selecionados!</span>
                </h1>
            </div>
            
            <div class="col-xxl-2 col-lg-1"></div>

            <div class="col-xxl-4 col-lg-5">

                <div class="box bg-white">
                    @if(isset($retorno))
                        @include('includes.error', ['retorno'=>$retorno])
                    @endif
                    
                    <form class="formValidate" method="POST" no-process>
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label class="with-icon" for=""><img src="{{asset('assets/img/icons/form-email.svg')}}"> Email*</label>
                            <input class="form-control" data-error="Email inválido" placeholder="meuemail@email.com" name="email" type="email" required="">
                            <div class="help-block with-errors"></div>
                        </div>

                        <button class="btn btn-primary w-100 margint15" type="submit">CONFIRMAR E-MAIL</button>
                    </form>

                    <div class="row vertical-row-center margint30">
                        <div class="col-7">
                            <p class="black-light t-m-p-min">Lembrou sua senha?</p>
                        </div>

                        <div class="col-5 text-end">
                            <p class="max t-m-p bold"><a href="{{url('/login')}}" class="blue underline">Fazer login</a></p>
                        </div>
                    </div>

                    {{-- Certo, agora confira seu email para alterar  sua senha! --}}
                    <div class="box-message-form box-success show-effect-cubic text-center">
                        <div class="close-box"></div>
                        <img src="{{asset('assets/img/icons/form-confirm-check.svg')}}" class="img-centered">
                        <p class="blue t-h3 margint10"></p>
                    </div>

                    <div class="box-message-form box-error show-effect-cubic text-center">
                        <div class="close-box"></div>
                        <img src="{{asset('assets/img/icons/form-error-close.svg')}}" class="img-centered">
                        <p class="red t-h3 margint10"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $('form').submit(function(event) {
        event.preventDefault();

        var dataForm = $(this).serialize();
        $.ajax({
            url: "{{route('ResetarSenha')}}",
            type: "POST",
            data: dataForm,
            success: function(result){
                $('.box-success p').html(result.mensagem);
                $('.box-success').addClass('open');
            },
            error: function(err, resp, text) {
                $('.box-error p').html(err.responseJSON.mensagem);
                $('.box-error').addClass('open');
            }
        });
        /*setTimeout(function(){
            window.location.href = 'esqueci-minha-senha-token';
        },2000);*/
    });

    $('.close-box').after().click(function(event) {
        event.preventDefault();
        $(this).parent().removeClass('open');
    });  
</script>

@stop