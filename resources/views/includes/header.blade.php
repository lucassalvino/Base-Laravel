<!DOCTYPE html>
<html lang="pt-Br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    {{--
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <title>
        @hasSection('title')
        {{config('app.name')}} - @yield('title')
        @else
        {{config('app.name')}}
        @endif
    </title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">

    {{-- Estilo de fontes ionicons --}}
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}?v=1.0">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <script src="{{asset('assets/js/main.js')}}?v=1.0"></script>
    @php
        if(!isset($data_seo)){
            $data_seo = [];
        }
    @endphp
    <meta name="description" content="{{$data_seo['descricao'] ?? ""}}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{$data_seo['titulo'] ?? ""}}" />
    <meta property="og:site_name" content="{{$data_seo['titulo'] ?? ""}}" />
    <meta property="og:url" content="{{$data_seo['url'] ?? url('/')}}" />
    <meta property="og:description" content="{{$data_seo['descricao'] ?? ""}}" />
    <meta property="og:locale" content="pt_BR" />
    <meta property="og:image" content="{{$data_seo['img_compartilhamento'] ?? ""}}" />
    <meta name="keywords" content="{{$data_seo['palavras_chave'] ?? ""}}" />
    <meta name="author" content="AUTORES">
    <link rel="shortcut icon" href="{{$data_seo['img_favicon'] ?? asset('assets/img/favicon.png')}}">
    <meta name="format-detection" content="telephone=no">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="{{asset('assets/js/validator.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.5/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script src="{{asset('assets/js/requisicaoformulario.js')}}?v=1.0"></script>
</head>

<body>
    <header class="header-bg">
    </header>
</body>