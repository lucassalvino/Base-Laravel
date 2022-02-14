<!doctype html>
<html lang="pt-BR">
<head>
    @include('admin.includes.header')
</head>
<body>

<div class="d-flex justify-content-center align-items-center w-100" style="height: 90vh;">
    <div class="d-flex w-50 ml-4 flex-column">
        <div class="d-flex flex-column justify-content-center align-items-center w-100 h-100">
            <div class="d-flex justify-content-center align-items-center flex-column mt-mobile">
                <h3 class="text-mobile-center form">Login Administrativo</h3>
            </div>
            <div class="d-flex mt-2 mobile-center" id="form-login">
                <form method="POST" class="form-publico w-100" action="{{ route('admin:realizar.login') }}"  no-process>
                    {{ csrf_field() }}
                    @if(isset($retorno))
                        @include('includes.error', ['retorno'=>$retorno])
                    @endif
                    <div class="d-flex flex-column">
                        <label for="user">Email:</label>
                        <input type="email" placeholder="Email" name="user" id="user">
                    </div>
                    <div class="d-flex flex-column mt-3">
                        <label for="password">Senha:</label>
                        <input type="password" placeholder="Senha" name="password" id="password">
                    </div>
                    <div class="d-flex mt-5 justify-content-center align-items-center mobile-center w-100">
                        <div class="d-flex">
                            <button class="btn btn-default shadow pl-4 pr-4">
                                Logar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
