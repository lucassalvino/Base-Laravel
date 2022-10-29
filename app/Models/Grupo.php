<?php
namespace App\Models;

use App\Models\Bases\BaseModel;
use App\Utils\Strings;
use Illuminate\Validation\Rule;

Class Grupo extends BaseModel{
    protected $table = 'grupo';
    protected $fillable = [
        'id', 'nome', 'slug'
    ];

    public function GetLikeFields(){
        return [
            'nome'
        ];
    }

    public function GetValidadorCadastro($request){
        return [
            'nome' => 'required|max:255',
            'slug' => 'required|unique:grupo|max:100'
        ];
    }

    public function GetValidadorAtualizacao($request, $id){
        return [
            'nome' => [ 'required', 'max:255' ],
            'slug' => [ 'required', 'max:100', Rule::unique('grupo')->ignore($id) ]
        ];
    }

    public function NormalizaDados(&$dados, $atualizacao = false){
        $existeNome = array_key_exists('nome', $dados);
        $existeSlug = array_key_exists('slug', $dados);
        if(!$existeSlug and $existeNome) {
            $dados['slug'] = Strings::slugify($dados['nome']);
        }
    }
}