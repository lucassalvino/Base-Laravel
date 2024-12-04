<?php

namespace App\Utils;

use Illuminate\Support\Facades\Cache;

class ApiCache{
    protected static $cacheTempo = null;

    public static function ObtemTempoCache() {
        if ( is_null(self::$cacheTempo) ) {
            self::$cacheTempo = env('CACHE_LIFE_TIME', 30);
        }
        return self::$cacheTempo;
    }

    public static function Existe($chave){
        return Cache::has($chave);
    }

    public static function AddCache($chave, $valor, $fatorTempo = 1){
        return Cache::put($chave, $valor, (static::ObtemTempoCache() * $fatorTempo));
    }

    public static function Obtem($chave){
        return Cache::get($chave);
    }

    public static function Remove($chave){
        Cache::forget($chave);
    }

    public static function LimpaCahce(){
        Cache::flush();
    }

    public static function GeraChaveRequest(Array $filtros){
        $filtros['APP_NAME'] = env('APP_NAME', 'CITSYSTEMS');
        return md5(json_encode($filtros));
    }

    public static function ObtemDadosCache($chave, $functionObtemDados, $fatorTempo = 1){
        if(ApiCache::Existe($chave)){
            return ApiCache::Obtem($chave);
        }
        $dado = $functionObtemDados();
        ApiCache::AddCache($chave, $dado, $fatorTempo);
        return $dado;
    }
}
