<?php
namespace App\Models\Categorizadores;

use App\Models\Bases\BaseModelCategorizadores;
use App\Models\Bases\ICategorizadores;
use Illuminate\Validation\Rule;

Class Sexo extends BaseModelCategorizadores implements ICategorizadores{

    protected $table = 'sexo';

    protected $fillable = [
        'id', 'descricao', 'slug'
    ];

    public function GetLikeFields(){
        return [
            'descricao', 'slug'
        ];
    }

    public function GetValidadorCadastro($request){
        return [
            'descricao' => 'required|max:100',
            'slug' => 'required|max:100|unique:sexo'
        ];
    }

    public function GetValidadorAtualizacao($request, $id){
        return [
            'descricao' => [ 'required', 'max:100' ],
            'slug' => [ 'required', 'max:100', Rule::unique('sexo')->ignore($id) ]
        ];
    }

    public static function ObtenhaRegistrosPadrao(){
        return Array(
            Array(
                'id' => 'd94d0c11-a3fe-476b-b298-d5eab31e0e95',
                'descricao' => 'Masculino',
                'slug' => 'masculino'
            ),
            Array(
                'id' => 'cc0ac151-d9a6-4ef2-95d7-ad8e07da1456',
                'descricao' => 'Feminino',
                'slug' => 'feminino'
            ),
            Array(
                'id' => '495d12e7-f37f-4a5a-9944-2ad44b20b07f',
                'descricao' => 'Unisex',
                'slug' => 'unisex'
            ),
            Array(
                'id' => '6ab08b67-9e65-47d5-9b67-9759c428f2ba',
                'descricao' => 'Outro',
                'slug' => 'outro'
            ),
            Array(
                'id' => static::$guidempty,
                'descricao' => 'Não definido',
                'slug' => 'naodefinido'
            )
        );
    }
}