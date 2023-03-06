<?php
namespace App\Models\Carteira;

use App\Models\Bases\BaseModel;

Class Carteira extends BaseModel{
    protected $table = 'usuario_carteira';
    protected $fillable = [
        'id', 'saldo_disponivel', 'saldo_a_receber', 'saldo_bloqueado',
        'ultima_atualizacao_saldos'
    ];
}