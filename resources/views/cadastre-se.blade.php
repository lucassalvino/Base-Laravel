@extends('layouts.padrao')
@section('title', 'Cadastre-se')

@section('content')

<section class="w-100 bg-logo-destak minvhtotal">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-6 col-lg-5"></div>

            <div class="col-xxl-4 col-lg-5">
                <h2 class="bold">Entrar</h2>
                <h3 class="black-light">Cadastre-se e seja um Selet!</h3>
            </div>
        </div>

        <div class="row justify-content-center margint30 margintm20 m-invert-column">
            <div class="col-xxl-4 col-lg-4 margintm30">
                <img src="{{asset('assets/img/logo-blue.svg')}}" class="logo-blue">
                <h1 class="t-m-h2 margint10 black-light">
                    Uma plataforma de produtores e afiliados que foi feita apenas para <span class="f-inter blue">selecionados!</span>
                </h1>
            </div>
            
            <div class="col-xxl-2 col-lg-1"></div>

            <div class="col-xxl-4 col-lg-5">

                <div class="box bg-white">
                    @if(isset($retorno))
                        @include('includes.error', ['retorno'=>$retorno])
                    @endif
                    
                    <form class="formValidate formAjax" method="POST" action="{{route('cadastra.usuario.csrf')}}" enctype="multipart/form-data" data-onsubmit data-redirect data-link="{{route('site.login')}}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="with-icon" for=""><img src="{{asset('assets/img/icons/form-nome.svg')}}"> Nome/Razão Social*</label>
                            <input class="form-control" data-error="Informação obrigatória" placeholder="Seu nome aqui" name="name" type="text" required="">
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <label class="with-icon" for=""><img src="{{asset('assets/img/icons/form-email.svg')}}"> Email*</label>
                            <input class="form-control" data-error="Email inválido" placeholder="meuemail@email.com" name="email" type="email" required="">
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <label class="with-icon" for=""><img src="{{asset('assets/img/icons/form-senha.svg')}}"> Senha*</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <button class="password-strength__visibility btn btn-outline-secondary" type="button" data-element="#password">
                                        <span class="password-strength__visibility-icon" data-visible="hidden">
                                            <i class="fas fa-eye-slash"></i>
                                        </span>
                                        <span class="password-strength__visibility-icon js-hidden" data-visible="visible">
                                            <i class="fas fa-eye"></i>
                                        </span>
                                    </button>
                                </div>
                            </div>
                            <input class="form-control" data-minlength="6" data-error="Senha com mínimo de 6 caracteres" placeholder="******" name="password" id="password" type="password" required="">
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group whit-errors-2-lines">
                            <label class="with-icon" for=""><img src="{{asset('assets/img/icons/form-senha.svg')}}"> Confirme sua senha*</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <button class="password-strength__visibility btn btn-outline-secondary" type="button" data-element="#confirmar_senha">
                                        <span class="password-strength__visibility-icon" data-visible="hidden">
                                            <i class="fas fa-eye-slash"></i>
                                        </span>
                                        <span class="password-strength__visibility-icon js-hidden" data-visible="visible">
                                            <i class="fas fa-eye"></i>
                                        </span>
                                    </button>
                                </div>
                            </div>
                            <input class="form-control" data-minlength="6" data-match="#password" data-error="Senha com mínimo de 6 caracteres" data-match-error="As senhas não combinam" placeholder="******" type="password" id="confirmar_senha" name="confirmar_senha" required="">
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group itemCustomCheckbox">
                            <label class="customCheckbox">
                                <input type="checkbox" data-error="Aceite os termos e Condições" required="">
                                <span class="checkmark"></span>
                                <p>Ao me inscrever aceito os <a href="#" class="blue bold" target="_blank">Termos e Condições</a></p>
                                <div class="help-block with-errors"></div>
                            </label>
                        </div>

                        <button class="btn btn-primary w-100 margint15" type="submit">CADASTRE-SE</button>
                    </form>

                    <div class="row vertical-row-center margint30">
                        <div class="col-7">
                            <p class="black-light t-m-p-min">Já possui uma conta?</p>
                        </div>

                        <div class="col-5 text-end">
                            <p class="max t-m-p bold"><a href="{{url('/login')}}" class="blue underline">Fazer login</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $('.password-strength__visibility').click(function() {
        var element = $($(this).attr('data-element'));
        
        if (element.attr('type') === 'password') {
            $(this).addClass('clicked');
            element.attr('type', 'text');
        } else {
            $(this).removeClass('clicked');
            element.attr('type', 'password');
        }
    });    
</script>

@stop