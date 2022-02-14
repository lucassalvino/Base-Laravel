<?php
namespace App\Models\Categorizadores;

use App\Models\Bases\BaseModelCategorizadores;
use App\Models\Bases\ICategorizadores;
use Illuminate\Validation\Rule;

Class TipoDocumento extends BaseModelCategorizadores implements ICategorizadores{

    protected $table = 'tipo_documento';
    protected $fillable = [
        'id', 'descricao', 'slug', 'funcao_validacao'
    ];

    public function GetLikeFields(){
        return [
            'descricao', 'slug'
        ];
    }

    public function GetValidadorCadastro($request){
        return [
            'descricao' => 'required|max:100',
            'slug' => 'required|max:100|unique:tipo_documento'
        ];
    }

    public function GetValidadorAtualizacao($request, $id){
        return [
            'descricao' => [ 'required', 'max:100' ],
            'slug' => [ 'required', 'max:100', Rule::unique('tipo_documento')->ignore($id) ]
        ];
    }

    public static function ObtenhaRegistrosPadrao(){
        return Array(
            Array(
                'id' => '36f85019-248c-44c4-ae1f-53d5bc04d64d',
                'descricao' => 'CPF',
                'slug' => 'cpf',
                'funcao_validacao' => 'App\Utils\Valida::CPF'
            ),
            Array(
                'id' => '5f44e20f-a436-43e7-a222-14588fa4b360',
                'descricao' => 'CNPJ',
                'slug' => 'cnpj',
                'funcao_validacao' => 'App\Utils\Valida::CNPJ'
            ),
            Array(
                'id' => static::$guidempty,
                'descricao' => 'Não Definido',
                'slug' => 'naodefinido',
                'funcao_validacao' => 'App\Utils\Valida::PadraoValido'
            )
        );
    }
}