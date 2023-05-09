<?php
namespace App\Models\CMS;

use App\Models\Bases\BaseModel;
use App\Utils\ApiCache;
use App\Utils\ArquivosStorage;

Class Banners extends BaseModel{
    protected $table = 'banners';
    protected $fillable = [
        'id', 'titulo', 'cortitulo', 'subtitulo', 'corsubtitulo', 'obs', 'corobs', 'path_mobile', 'path_desktop', 'url'
    ];

    public static function ObtemBannersVisualizar(){
        $chave = ApiCache::GeraChaveRequest(['TODOS_BANNERS']);
        return ApiCache::ObtemDadosCache($chave, function(){
            $retorno = Banners::query()
            ->orderBy('created_at')
            ->get([
                'id', 'titulo', 'cortitulo', 'subtitulo', 'corsubtitulo', 'obs', 'corobs', 'path_mobile', 'path_desktop', 'url'
            ]);
            for($i = 0; $i < count($retorno); $i++){
                $retorno[$i]->path_desktop = ArquivosStorage::GetUrlView($retorno[$i]->path_desktop);
                $retorno[$i]->path_mobile = ArquivosStorage::GetUrlView($retorno[$i]->path_mobile);
            }
            return $retorno;
        }, 2);
    }
}