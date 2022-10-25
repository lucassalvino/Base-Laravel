<?php

namespace App\Models\Configuracoes;

use App\Models\Bases\BaseModel;
use Illuminate\Validation\Rule;

class TokensAPI extends BaseModel{
    protected $table = "api_key_integracao";
    protected $fillable = [ "id", "usuario_id", "descricao", "api_key" ];

    public function GetValidadorCadastro($request){
        return [
            'usuario_id' => 'required|exists:users,id',
            'descricao' => 'required|max:300',
            'api_key' => 'required|unique:api_key_integracao|max:300'
        ];
    }

    public function GetValidadorAtualizacao($request, $id){
        $validador = $this->GetValidadorCadastro($request);
        $validador['api_key'] = ['required', 'max:300', Rule::unique('api_key_integracao')->ignore($id)];
        return $validador;
    }
}