<?php
namespace App\Models\Menu;

use App\Models\Bases\BaseModel;

Class GrupoMenuHistorico extends BaseModel{
    protected $table = 'grupo_menu';
    protected $fillable = [
        'id', 'grupo_id', 'menu_id', 'usuario_id',
        'stamp'
    ];
}