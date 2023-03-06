<?php
namespace App\Models\Carteira;

use App\Models\Bases\BaseModel;

Class Recebedor extends BaseModel{
    protected $table = 'usuario_recebedor';
    
    protected $fillable = [
        'id', 'usuario_id', 'tipo_recebedor', 'status', 'principal', 'chave_pix',
        'tipo_chave_pix', 'nome_titular', 'email', 'descricao', 'documento',
        'tipo_pessoa_recebedor', 'banco', 'agencia', 'digito_verificador_agencia',
        'numero_conta', 'digito_verificador_conta', 'tipo_conta'
    ];
}