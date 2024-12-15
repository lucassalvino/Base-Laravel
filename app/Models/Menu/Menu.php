<?php
namespace App\Models\Menu;

use App\Models\Bases\BaseModel;

Class Menu extends BaseModel{
    protected $table = 'menus';
    protected $fillable = [
        'id', 'nome', 'path', 'icone', 'parent_id', 'ordem'
    ];

    public function GetLikeFields(){
        return [
            'nome'
        ];
    }

    public function GetValidadorCadastro($request){
        return [
            'nome' => 'required|max:200',
            'path' => 'required|max:200',
            'icone' => 'required|max:200'
        ];
    }
}