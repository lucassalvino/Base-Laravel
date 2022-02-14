<!DOCTYPE html>
<html lang="pt-Br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" ></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
        <title>
            {{config('app.name')}} - @yield('title')
        </title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">

        {{-- Estilo de fontes ionicons --}}
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

        <link rel="stylesheet" href="{{asset('assets/css/main.css')}}?v=1.0">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

        <script src="{{asset('assets/js/main.js')}}?v=1.0"></script>

        <meta name="description" content="DESCRICAO"/>
        <meta property="og:type" content="website"/>
        <meta property="og:title" content="NOME" />
        <meta property="og:site_name" content="NOME" />
        <meta property="og:url" content="LINK" />
        <meta property="og:description" content="DESCRICAO" />
        <meta property="og:locale" content="pt_BR" />
        <meta property="og:image" content="IMG PADRAO"/>
        <meta name="keywords" content="PALAVRAS" />
        <meta name="author" content="AUTORES">
        <link rel="shortcut icon" href="{{asset('assets/img/favicon.png')}}">
        <meta name="format-detection" content="telephone=no">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="{{asset('assets/js/validator.min.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.5/dist/sweetalert2.all.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <script src="{{asset('assets/js/requisicaoformulario.js')}}?v=1.0"></script>

        {{-- <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Mina:wght@400;700&display=swap" rel="stylesheet"> --}}
    </head>
    <body>

        <nav class="navbar navbar-expand-lg bg-blue fixed-top">
            <div class="container">
                <div class="row vertical-row-center">
                    <div class="col-lg-6">
                        <a class="navbar-brand" href="{{ url('/home') }}">
                            <img src="{{asset('assets/img/logo.png')}}">
                        </a>
                    </div>
                    <div class="col-lg-6">
                        @hasSection('auth')
                            <div class="hidden-m">
                                <div class="nav-content">
                                    <ul class="list-itens-icons">
                                        <li><a href="#"><img src="{{asset('assets/img/icons/nav-heart.svg')}}"><span>1</span></a></li>
                                        <li><a href="#"><img src="{{asset('assets/img/icons/nav-cart.svg')}}"><span>1</span></a></li>
                                        <li><a href="#"><img src="{{asset('assets/img/icons/nav-bell.svg')}}"><span>1</span></a></li>
                                    </ul>
                                    <div class="dropdown nav-user-dropdown">
                                        <div class="dropdown-toggle nav-user-header" id="dropdownNavUser" data-bs-toggle="dropdown" aria-expanded="false">
                                            @if(Session::has('usuarioAvatar'))
                                                <img src="{{ Session::get('usuarioAvatar')}}" class="avatar">
                                            @else
                                                <img src="{{asset('assets/img/icons/user.svg')}}" class="avatar">
                                            @endif
                                            <span class="max_line max_line_1">
                                                @if(Session::has('usuarioNome'))
                                                    {{ Session::get('usuarioNome')}}
                                                @endif
                                            </span>
                                            <img src="{{asset('assets/img/icons/nav-carret.png')}}" class="carret">
                                        </div>
                                        <div class="dropdown-menu" aria-labelledby="dropdownNavUser">
                                            <div class="nav-user-content">
                                                @if(Session::has('usuarioAvatar'))
                                                    <img src="{{ Session::get('usuarioAvatar')}}" class="avatar">
                                                @else
                                                    <img src="{{asset('assets/img/icons/user.svg')}}" class="avatar">
                                                @endif
                                                <div class="content">
                                                    <p class="name max_line max_line_1">
                                                        @if(Session::has('usuarioNome'))
                                                            {{ Session::get('usuarioNome')}}
                                                        @endif
                                                    </p>
                                                    <p class="email">
                                                        @if(Session::has('usuarioEmail'))
                                                            {{ Session::get('usuarioEmail')}}
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                            <ul>
                                                <li><a href="#"><img src="{{asset('assets/img/icons/nav-drop-user.svg')}}">Editar meu perfil</a></li>
                                                <li><a href="#"><img src="{{asset('assets/img/icons/nav-drop-star.svg')}}">Meus cursos</a></li>
                                                <li><a href="#"><img src="{{asset('assets/img/icons/nav-drop-bell.svg')}}">Receber Notificações</a></li>
                                                <li><a href="{{ url('/logout') }}"><img src="{{asset('assets/img/icons/nav-drop-logout.svg')}}">Sair da Conta</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>            
            </div>
        </nav>