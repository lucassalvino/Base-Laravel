<?php
namespace App\Models;

use App\Models\Bases\BaseModel;

Class DuvidasFrequentes extends BaseModel{
    protected $table = 'duvidas_frequentes';

    protected $fillable = [
        'id', 'titulo', 'ordem', 'resposta'
    ];

    public function GetValidadorCadastro($request){
        return [
            'titulo' => ['required', 'max:255'],
            'ordem' => 'required',
            'resposta' => 'required'
        ];
    }

    public function NormalizaDados(&$dados, $atualizacao = false){
        if(!array_key_exists('ordem', $dados)){
            $dados['ordem'] = 0;
        }
    }
}