<?php
namespace App\Models;

use App\Models\Bases\BaseModel;

Class HistoricoAlteracaoSenha extends BaseModel{
    protected $table = 'historico_alteracao_senha';
    protected $fillable = [
        'id', 'usuario_id', 'usuario_acao_id', 'user_agent', 'endereco_ip_request',
        'endereco_ip_real', 'host_request', 'sucesso_alteracao', 'stamp'
    ];

    public static function CriaHistoricoAlteracaoSenha($insertArray){
        $arrayStamp = $insertArray;
        if(array_key_exists('sucesso_alteracao', $arrayStamp)){
            unset($arrayStamp['sucesso_alteracao']);
        }
        $insertArray['stamp'] = hash('sha256', json_encode($arrayStamp));
        return HistoricoAlteracaoSenha::create($insertArray);
    }
}