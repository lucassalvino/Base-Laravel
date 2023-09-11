<?php

namespace App\Http\Middleware;

use App\Models\Configuracoes\WhiteList;
use App\Utils\ApiCache;
use App\Utils\BaseRetornoApi;
use Closure;
class WhiteListMiddleware{
    public function getIp(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip);
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
        return request()->ip();
    }

    public function ObtemWhiteLists(){
        return ApiCache::ObtemDadosCache(
            ApiCache::GeraChaveRequest(['WHITE_LIST']),
            function(){
                $dados = WhiteList::query()->get(['valor'])->pluck('valor')->toArray();
                return $dados;
            }
        );
    }

    public function handle($request, Closure $next){
        $ipCliente = trim($this->getIp());
        $host = trim($request->getHttpHost());
        $white = $this->ObtemWhiteLists();
        if(in_array($ipCliente, $white) || in_array($host, $white)){
            return $next($request->merge(['white_list_verificado' => true]));
        }else{
            return BaseRetornoApi::GetRetornoNaoAutorizado("Esse token não existe ou já foi deslogado");
        }
    }
}