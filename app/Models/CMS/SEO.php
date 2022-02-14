<?php
namespace App\Models\CMS;

use App\Models\Bases\BaseModel;

Class SEO extends BaseModel{
    protected $table = 'seo';
    protected $fillable = [
        'id', 'descricao', 'titulo', 'url', 'palavras_chave', 'script_tracking'
    ];
}