<?php

namespace App\Servicos;

use App\Models\CMS\Pagina;
use App\Models\CMS\TermosAceite;
use App\Utils\ApiCache;
use App\Utils\ArquivosStorage;

class PaginaServico{
    public static function ObtemPagina($slug){
        return ApiCache::ObtemDadosCache(
            ApiCache::GeraChaveRequest(['pagina-view' => $slug]),
            function()use($slug){
                $pagina = Pagina::query()
                    ->where('pagina.slug', 'ilike', trim($slug))
                ->first();

                if(!$pagina){
                    return null;
                }

                $pagina->thumbnail = ArquivosStorage::GetUrlView($pagina->thumbnail);
                return $pagina;
            }
        );
    }

    public static function ObtemTermosAceite($slug){
        return ApiCache::ObtemDadosCache(
            ApiCache::GeraChaveRequest(['termos-aceite' => $slug]),
            function() use ($slug){
                $termo = TermosAceite::query()
                    ->where('termos_aceite.slug', '=', $slug)
                ->first();

                if(!$termo){
                    return null;
                }
                return $termo;
            }
        );
    }
}