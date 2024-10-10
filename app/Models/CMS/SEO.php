<?php
namespace App\Models\CMS;

use App\Models\Bases\BaseModel;

Class SEO extends BaseModel{
    protected $table = 'seo';
    protected $fillable = [
        'id', 'descricao', 'titulo', 'url', 'palavras_chave', 'script_tracking'
    ];
    
    public const KEY_CACHE = "SEO_CACHE_KEY";

    public function GetValidadorCadastro($request){
        return [
            'descricao' => ['required', 'max:500'],
            'titulo' => ['required', 'max:120'],
            'url' => ['required', 'max:255'],
            'palavras_chave' => ['required', 'max:500']
        ];
    }

    public function NormalizaDados(&$dados, $atualizacao = false){
        if(Strings::isNullOrEmpty($dados['script_tracking']??null)){
            $dados['script_tracking'] = "<script></script>";
        }
    }

    public static function ObtemSeo(){
        return ApiCache::ObtemDadosCache(
            ApiCache::GeraChaveRequest([self::KEY_CACHE]),
            function(){
                return SEO::query()->first();
            },
            200
        );
    }

    public static function clearCache(){
        ApiCache::Remove(ApiCache::GeraChaveRequest([self::KEY_CACHE]));
    }

    protected static function boot(){
        parent::boot();
        self::creating(function ($model) {
            self::clearCache();
        });
        self::updating(function($model){
            self::clearCache();
        });
        self::deleting(function($model){
            self::clearCache();
        });
    }
}