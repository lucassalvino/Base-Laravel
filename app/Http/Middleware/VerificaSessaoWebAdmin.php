<?php

namespace App\Http\Middleware;

use App\Servicos\LoginServico;
use Closure;

class VerificaSessaoWebAdmin{

    public function handle($request, Closure $next){
        $token = session('Authorization', '');
        $sessao = LoginServico::ObtemSessao($token);

        if(isset($sessao)){
            if(LoginServico::UsuarioAdmin($sessao)){
                return $next($request->merge(['sessao' => $sessao]));
            }else{
                return redirect()->route('site.login');    
            }
        }else{
            return redirect()->route('admin:login');
        }
    }
}