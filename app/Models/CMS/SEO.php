<?php
namespace App\Models\CMS;

use App\Models\Bases\BaseModel;
use App\Utils\ApiCache;
use App\Utils\ArquivosStorage;
use App\Utils\Strings;

Class SEO extends BaseModel{
    protected $table = 'seo';
    protected $fillable = [
        'id', 'descricao', 'titulo', 'url', 'palavras_chave',
        'script_tracking', 'img_compartilhamento', 'social_links',
        'img_favicon'
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
        if(array_key_exists('social_links', $dados)){
            $dados['social_links'] = json_encode($dados['social_links']);
        }
        if(array_key_exists('base_img_compartilhamento', $dados) && array_key_exists('tipo_img_compartilhamento', $dados)){
            $nomeArquivo = self::SalvaImagem($dados['base_img_compartilhamento'], $dados['tipo_img_compartilhamento']);
            if($nomeArquivo)
                $dados['img_compartilhamento'] = $nomeArquivo;
        }
        if(array_key_exists('base_img_favicon', $dados) && array_key_exists('tipo_img_favicon', $dados)){
            $nomeArquivo = self::SalvaImagem($dados['base_img_favicon'], $dados['tipo_img_favicon']);
            if($nomeArquivo)
                $dados['img_favicon'] = $nomeArquivo;
        }
    }

    public static function ObtemSeo(){
        return ApiCache::ObtemDadosCache(
            ApiCache::GeraChaveRequest([self::KEY_CACHE]),
            function(){
                $seo = SEO::query()->first();
                if($seo){
                    $seo->img_compartilhamento = ArquivosStorage::GetUrlView($seo->img_compartilhamento);
                    $seo->img_favicon = ArquivosStorage::GetUrlView($seo->img_favicon);
                }
                return $seo;
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