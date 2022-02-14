<?php

namespace App\Http\Middleware;

use App\Models\Login;
use App\Utils\BaseRetornoApi;
use Closure;

class VerificaSessao{
    private function ObtemSessao($token){
        return Login::query()
        ->where('api_token', '=', $token)
        ->first();
    }

    public function handle($request, Closure $next){
        $token = $request->header('Authorization');
        $sessao = $this->ObtemSessao($token);

        if(isset($sessao)){
            return $next($request->merge(['sessao'=>$sessao]));
        }else{
            return BaseRetornoApi::GetRetornoNaoAutorizado("Esse token não existe ou já foi deslogado");
        }
    }
}