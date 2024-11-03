@php
    if (!isset($titulo)) {
        $titulo = 'Titulo';
    }
    if (!isset($migalhas)) {
        $migalhas = [];
    }
    if (!isset($menuativo)) {
        $menuativo = '';
    }
    if (!isset($menuexpand)) {
        $menuexpand = '';
    }

    $gatewayClientes = [];
    $dataRequest = request()->all();
    if (array_key_exists('GatewayClients', $dataRequest)) {
        $gatewayClientes = $dataRequest['GatewayClients'];
    }
    $settings = [];
    $client = null;
    foreach ($gatewayClientes as $gt) {
        if (($_GET['gateway_client_id'] ?? '') == $gt->id) {
            $client = $gt;
            break;
        }
    }
    if (is_null($client) && count($gatewayClientes) > 0) {
        $client = $gatewayClientes[0];
    }
    if (!is_null($client)) {
        $settings = json_decode($client->settings, true);
    }
    $pathImg = App\Utils\ArquivosStorage::GetUrlView($settings['path_logo'] ?? '');
@endphp

<!DOCTYPE html>
<html lang="pt-Br">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>CIT Systems</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="CIT Systems">
    <meta name="author" content="CIT Systems">
    <meta name="description" content="CIT Systems">
    <meta name="keywords" content="CIT Systems">
    <link rel="shortcut icon" href="{{ asset('assets/img/logo-cit.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css"
        integrity="sha256-dSokZseQNT08wYEWiz5iLI8QPlKxG+TswNRD8k35cpg=" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css"
        integrity="sha256-Qsx5lrStHZyR9REqhUF8iQt73X06c8LGIUPzpOhwRrI=" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/adminlte/css/adminlte.css')}}?v=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
        integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css"
        integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4=" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.datetimepicker.min.css') }}?v=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.5/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        <nav class="app-header navbar navbar-expand bg-body">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                            <i class="bi bi-list"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <select name="gateway_client" id="gateway_client" class="form-select">
                            @foreach ($gatewayClientes as $gt)
                                <option value="{{ $gt->id }}" @if (($_GET['gateway_client_id'] ?? '') == $gt->id) selected @endif>
                                    {{ $gt->name }}</option>
                            @endforeach
                        </select>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                            <i class="bi bi-search"></i>
                        </a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="#" data-lte-toggle="fullscreen"> <i
                                data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i> <i
                                data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none;"></i> </a>
                    </li>
                    <li class="nav-item dropdown user-menu">
                        <button href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="{{ session('usuarioAvatar', '') }}" class="user-image rounded-circle shadow"
                                alt="User Image">
                            <span class="d-none d-md-inline">{{ session('usuarioNome') }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <li class="user-header text-bg-primary"> 
                                <img src="{{ session('usuarioAvatar', '') }}" class="rounded-circle shadow" alt="User Image">
                                <p>
                                    {{ session('usuarioNome') }}
                                    <small>{{ session('usuarioEmail') }}</small>
                                </p>
                            </li>
                            <li class="user-body">
                                <div class="row">
                                    <div class="col-4 text-center"> <a href="#">Tema</a> </div>
                                </div>
                            </li>
                            <li class="user-footer">
                                <a href="#" class="btn btn-default btn-flat">Perfil</a>
                                <a href="{{ route('fazer.logout') }}"
                                    class="btn btn-default btn-flat float-end"> Logout </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
            <div class="sidebar-brand">
                <a href="{{ route('painel:home.painel') }}" class="brand-link">
                    @if ($client)
                        <img src="{{ $pathImg ?? asset('assets/img/logo-cit.png') }}" alt="CIT"
                            class="brand-image opacity-75 shadow">
                    @else
                        <img src="{{ asset('assets/img/logo-cit.png') }}" alt="CIT"
                            class="brand-image opacity-75 shadow">
                    @endif
                    <span class="brand-text fw-light">{{ $client->name ?? 'CIT' }}</span>
                </a>
            </div>
            <div class="sidebar-wrapper">
                <nav class="mt-2">
                    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item"> <a href="#" class="nav-link menu-dashboard"> <i
                                    class="nav-icon bi bi-speedometer"></i>
                                <p>
                                    Dashboard
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('painel:home.painel') }}" class="nav-link menu-status">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Status</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <main class="app-main">
            @component('includes.Componentes.Painel.titulo')
                @slot('titulo', $titulo),
                @slot('migalhas', $migalhas)
            @endcomponent
            <div class="app-content">
                @yield('content')
            </div>
        </main>
        @yield('modais')
        <footer class="app-footer">
            <div class="float-end d-none d-sm-inline"></div><strong>
                Copyright &copy; {{ date('Y') }}&nbsp;
                <a href="{{ route('home.site') }}" class="text-decoration-none">CITSystems</a>.
            </strong>
            Todos os direitos reservados.
        </footer>
    </div>
    <script>
        var paginajsimport = `{{ App\Utils\Strings::slugify($titulo) }}`;
    </script>
    <script src="{{ asset('/assets/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js"
        integrity="sha256-H2VM7BKda+v2Z4+DRy69uknwxjyDRhszjXFhsL4gD3w=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha256-whL0tQWoY1Ku1iskqPFvmZ+CHsvmRWx/PIoEvIeWh4I=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="{{ asset('assets/js/jquery.datetimepicker.min.js') }}?v=1.0"></script>
    <script src="{{ asset('assets/js/jquery.maskMoney.js') }}?v=1.0"></script>
    <script src="{{ asset('assets/adminlte/js/adminlte.js') }}"></script>
    <script src="{{ asset('assets/adminlte/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.5/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"
        integrity="sha256-ipiJrswvAR4VAx/th+6zWsdeYmVae0iJuiR+6OqHJHQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
        integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/js/jsvectormap.min.js"
        integrity="sha256-/t1nN2956BT869E6H4V1dnt0X5pAQHPytli+1nTZm2Y=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/maps/world.js"
        integrity="sha256-XPpPaZlU8S/HWf7FZLAncLg2SAkP8ScUTII89x9D3lY=" crossorigin="anonymous"></script>
    @yield('scripts_adicionais')
    <script>
        $(document).ready(function() {
            $("#gateway_client").on("change", function() {
                var url = new URL(window.location.href);
                url.searchParams.set('gateway_client_id', $("#gateway_client").val());
                window.location.href = url.toString();
            });
            $(".nav-link").removeClass('active');
            $(".menu-open").removeClass('menu-open');
            @if ($menuativo)
                @php
                    $menuativo = explode('|', $menuativo);
                @endphp
                @foreach ($menuativo as $menu)
                    $(".{{ $menu }}").addClass('active');
                    if($(".{{ $menu }} .bi-circle").length){
                        $(".{{ $menu }} .bi-circle").removeClass("bi-circle").addClass("bi-circle-fill");
                    }
                @endforeach
            @endif
            @if ($menuexpand)
                @php
                    $menuexpand = explode('|', $menuexpand);
                @endphp
                @foreach ($menuexpand as $menu)
                    $($(".{{ $menu }}").parent()).addClass('menu-open');
                @endforeach
            @endif
        });
    </script>
</body>

</html>
