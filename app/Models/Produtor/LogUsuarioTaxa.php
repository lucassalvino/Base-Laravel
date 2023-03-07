<?php
namespace App\Models\Produtor;

use App\Models\Bases\BaseModel;

class LogUsuarioTaxa extends BaseModel{
    protected $table = "usuario_taxa_log";
    protected $fillable = [
        'id', 'usuario_id', 'usuario_taxa_id', 'alteracoes'
    ];
}