<?php

namespace App\Models\Configuracoes;

use App\Models\Bases\BaseModel;
use App\Models\Enuns\TipoWhiteList;
use App\Rules\ValidaEnum;
use Illuminate\Validation\Rule;

class WhiteList extends BaseModel{
    protected $table = "white_list";
    protected $fillable = [ "id", "tipo", "valor", "descricao" ];

    public function GetValidadorCadastro($request){
        return [
            'tipo' => ['required', new ValidaEnum(TipoWhiteList::class)],
            'valor' => ['required', 'max:300', 'unique:white_list'],
        ];
    }

    public function GetValidadorAtualizacao($request, $id){
        $validador = $this->GetValidadorCadastro($request);
        $validador['valor'] = ['required', 'max:300', Rule::unique('white_list')->ignore($id)];
        return $validador;
    }
}