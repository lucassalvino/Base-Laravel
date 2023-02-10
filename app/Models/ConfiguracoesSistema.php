<?php
namespace App\Models;

use App\Models\Bases\BaseModel;
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
}
