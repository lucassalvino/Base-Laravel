@extends('layouts.padrao')
@section('title', 'Esqueci minha senha Token')

@section('content')

<section class="w-100 bg-logo-destak minvhtotal">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-6 col-lg-5"></div>

            <div class="col-xxl-4 col-lg-5">
                <h2 class="bold">Olá!</h2>
                <h3 class="black-light">Insira o Token</h3>
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
                            <label class="with-icon" for=""><img src="{{asset('assets/img/icons/form-senha.svg')}}"> Insira o código*</label>
                            <input class="form-control" data-minlength="6" data-error="Token com mínimo de 6 caracteres" placeholder="******" name="token" id="token" type="password" required="">
                            <div class="help-block with-errors"></div>
                        </div>

                        <button class="btn btn-primary w-100 margint15" type="submit">RECUPERAR SENHA</button>
                    </form>

                    <div class="row vertical-row-center margint30">
                        <div class="col-6">
                            <p class="black-light t-m-p-min">Não recebeu o Token?</p>
                        </div>

                        <div class="col-6 text-end">
                            <p class="max t-m-p bold"><a href="#" class="blue underline open-show-effect-cubic">Enviar novamente</a></p>
                        </div>
                    </div>

                    <div class="box-confirm-form show-effect-cubic text-center">
                        <img src="{{asset('assets/img/icons/form-confirm-check.svg')}}" class="img-centered">
                        <p class="blue t-h3 margint10">Certo, agora confira seu email para alterar  sua senha!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $('.open-show-effect-cubic').click(function(event) {
        event.preventDefault();
        $('.show-effect-cubic').addClass('open');
        setTimeout(function(){
            $('.show-effect-cubic').removeClass('open');
        },2000);
    });    
</script>

@stop