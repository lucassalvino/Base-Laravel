<?php
namespace App\Models;

use App\Models\Bases\BaseModel;

Class Duvidas extends BaseModel{
    protected $table = 'duvidas';
    protected $fillable = [
        'id', 'titulo', 'ordem', 'resposta'
    ];
}