<?php
namespace App\Models;

use App\Models\Bases\BaseModel;
use App\Utils\ApiCache;
use Exception;

Class ConfiguracoesSistema extends BaseModel{

    protected $table = 'configuracoes_sistema';
    protected $fillable = [
        'id', 'quantidade_sessoes_permitidas', 'usuario_sistema_id'
    ];

    public function GetValidadorCadastro($request){
        return [
            'quantidade_sessoes_permitidas' => 'numeric|min:1',
            'usuario_sistema_id' => 'exists:users,id'
        ];
    }
    
    public static function ObtemConfiguracaoCache(){
        return ApiCache::ObtemDadosCache(
            ApiCache::GeraChaveRequest(["Configuracao_Sistema"]),
            function(){
                $config = self::query()->first();
                if(!$config){
                    throw new Exception("Configuração do sistema não foi encontrada");
                }
                return $config;
            }, 4);
    }

    public function EventoAlteracao($id, $atualizacao = true){
        ApiCache::Remove(ApiCache::GeraChaveRequest(["Configuracao_Sistema"]));
    }
}
