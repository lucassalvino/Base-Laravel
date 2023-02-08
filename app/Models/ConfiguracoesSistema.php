<?php
namespace App\Models;

use App\Models\Bases\BaseModel;
Class ConfiguracoesSistema extends BaseModel{
    
    protected $table = 'configuracoes_sistema';
    protected $fillable = [
        'id', 'quantidade_sessoes_permitidas'
    ];
}