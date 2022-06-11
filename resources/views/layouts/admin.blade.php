<!doctype html>
<html lang="pt-BR">
<head>
    @include('admin.includes.header')
    @yield('graficos-google')
</head>
<style>
    .ativo{
        background-color: #0000004A;
    }
</style>
<body>
    <div class="page-wrapper chiller-theme toggled">
        <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
            <i class="fas fa-bars"></i>
        </a>
        <nav id="sidebar" class="sidebar-wrapper">
            <div class="sidebar-content">
                <div class="sidebar-brand">
                    <a href="{{route('admin:home')}}">{{config('app.name')}}</a>
                    <div id="close-sidebar">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                <div class="sidebar-header">
                    <div class="user-pic">
                        <img class="img-responsive img-rounded" src="{{ session('usuarioAvatar','') }}" alt="Avatar usuário">
                    </div>
                    <div class="user-info">
                        <span class="user-name">
                            {{ session('usuarioNome', '') }}
                        </span>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul>
                        <li class="sidebar-dropdown" id="menu-usuarios">
                            <a href="#">
                                <i class="fas fa-users"></i>
                                <span>Usuários</span>
                            </a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a href="{{route('admin:usuario.index')}}">Usuários</a>
                                    </li>
                                    <li>
                                        <a href="{{route('admin:grupousuarios.index')}}">Grupos</a>
                                    </li>
                                    <li>
                                        <a href="{{route('admin:construindo')}}">Permissões</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        </li>
                    </ul>
                </div>
                <div class="sidebar-menu">
                    <ul>
                        <li class="sidebar-dropdown" id="menu-cms">
                            <a href="#">
                                <i class="fas fa-globe"></i>
                                <span>CMS</span>
                            </a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a href="{{route('admin:home.seo')}}">SEO</a>
                                    </li>
                                    <li>
                                        <a href="{{route('admin:cms.banner')}}">Banners</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="sidebar-footer">
                <a href="#">
                    <i class="fa fa-bell"></i>
                    <span class="badge badge-pill badge-warning notification">0</span>
                </a>
                <a href="#">
                    <i class="fa fa-envelope"></i>
                    <span class="badge badge-pill badge-success notification">0</span>
                </a>
                <a href="#" data-toggle="modal" data-target="#modallogout">
                    <i class="fa fa-power-off"></i>
                </a>
            </div>
        </nav>
        <div class="modal fade" id="modallogout" tabindex="-1" role="dialog" aria-labelledby="modallogoutTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Você realmente quer sair?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Quando fizer logout será necessário logar novamente para ter acesso</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                        <a href={{route('admin:realizar.logout')}} class="btn btn-danger">Logout</a>
                    </div>
                </div>
            </div>
        </div>
        <main class="page-content">
            <div class="container-fluid">
                @yield('content')
                <hr>
                <footer class="text-center">
                    <div class="mb-2">
                        <small class="d-flex justify-content-center align-items-center" style="font-size: 18px;">
                            <i class="fab fa-laravel"></i> &nbsp; <a target="_blank" rel="noopener noreferrer" href="https://github.com/">
                                Git
                            </a>
                        </small>
                    </div>
                </footer>
            </div>
        </main>
    </div>
</body>
</html>
