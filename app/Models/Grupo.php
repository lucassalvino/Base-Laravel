<?php
namespace App\Models;

use App\Models\Bases\BaseModel;
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
            $dados['slug'] = self::slugify($dados['nome']);
        }
    }

    public static function slugify($text, string $divider = '-'){
        // replace non letter or digits by divider
        $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, $divider);

        // remove duplicate divider
        $text = preg_replace('~-+~', $divider, $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }
        return $text;
    }

}