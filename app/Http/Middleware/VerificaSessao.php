<?php

namespace App\Http\Middleware;

use App\Servicos\LoginServico;
use App\Utils\BaseRetornoApi;
use Closure;

class VerificaSessao{

    public function handle($request, Closure $next){
        $token = $request->header('Authorization');
        $sessao = LoginServico::ObtemSessao($token);

        if(isset($sessao)){
            return $next($request->merge(['sessao'=>$sessao]));
        }else{
            return BaseRetornoApi::GetRetornoNaoAutorizado("Esse token não existe ou já foi deslogado");
        }
    }
}