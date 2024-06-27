<?php
namespace App\Models;

use App\Models\Bases\BaseModel;

Class Contatos extends BaseModel{
    protected $table = 'contatos';

    protected $fillable = [
        'id', 'nome', 'email', 'telefone', 'assunto', 'mensagem'
    ];

    public function GetValidadorCadastro($request){
        return [
            'nome' => ['required', 'max:255'],
            'email' => 'required|email',
            'telefone' => ['required', 'max:15'],
            'assunto' => 'required',
            'mensagem' => 'required'

        ];
    }
}