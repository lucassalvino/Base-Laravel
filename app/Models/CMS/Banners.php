<?php
namespace App\Models\CMS;

use App\Models\Bases\BaseModel;
use App\Utils\ArquivosStorage;

Class Banners extends BaseModel{
    protected $table = 'banners';
    protected $fillable = [
        'id', 'titulo', 'cortitulo', 'subtitulo', 'corsubtitulo', 'obs', 'corobs', 'patch_mobile', 'patch_descktop', 'url'
    ];

    public static function ObtemBannersVisualizar(){
        $retorno = Banners::query()->get();
        for($i = 0; $i < count($retorno); $i++){
            $retorno[$i]->patch_descktop = ArquivosStorage::GetUrlView($retorno[$i]->patch_descktop);
            $retorno[$i]->patch_mobile = ArquivosStorage::GetUrlView($retorno[$i]->patch_mobile);
        }
        return $retorno;
    }
}