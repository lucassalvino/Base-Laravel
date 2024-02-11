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

    public function GetValidadorAtualizacao($request, $id){
        $valida = $this->GetValidadorCadastro($request);
        $valida['titulo'] = ['required', 'max:255'];
        return $valida; 
    }
}