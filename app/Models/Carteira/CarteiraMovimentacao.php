<?php
namespace App\Models\Carteira;

use App\Models\Bases\BaseModel;

Class CarteiraMovimentacao extends BaseModel{
    protected $table = 'usuario_carteira_movimentacao';
    protected $fillable = [
        'id', 'usuario_carteira_id', 'saldo_antes_movimentacao', 'saldo_depois_movimentacao',
        'valor_movimentacao', 'descricao_curta', 'descricao', 'dados_movimentacao',
        'status', 'tipo_movimentacao', 'data_disponivel', 'usuario_id', 'parent_id', 'hash'
    ];

    public function Carteira() {
        return $this->belongsTo(Carteira::class, 'usuario_carteira_id', 'id');
    }
}