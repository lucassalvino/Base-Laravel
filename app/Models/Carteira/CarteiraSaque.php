<?php
namespace App\Models\Carteira;

use App\Models\Bases\BaseModel;

Class CarteiraSaque extends BaseModel{
    protected $table = 'usuario_carteira_saque';
    protected $fillable = [
        'id', 'usuario_recebedor_id', 'usuario_id', 'usuario_carteira_id',
        'valor_solicitado', 'status', 'requisicao', 'response'
    ];
}