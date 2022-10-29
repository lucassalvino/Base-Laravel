<?php
namespace App\Models;

use App\Models\Bases\BaseModel;

Class MultimidiaArquivos extends BaseModel{
    protected $table = 'multimidia_arquivos';
    protected $fillable = [
        'id', 'usuario_id', 'path_relativo', 'model'
    ];
}