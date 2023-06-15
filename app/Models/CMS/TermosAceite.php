<?php
namespace App\Models\CMS;

use App\Models\Bases\BaseModel;
use App\Utils\Strings;
use Illuminate\Validation\Rule;

Class TermosAceite extends BaseModel{
    protected $table = 'termos_aceite';
    protected $fillable = [
        'id', 'nome', 'slug', 'conteudo'
    ];

    public function GetLikeFields(){
        return [
            'nome', 'slug', 'conteudo'
        ];
    }

    public function GetValidadorCadastro($request){
        return [
            'nome' => 'required|max:300',
            'slug' => 'required|max:300|unique:termos_aceite',
            'conteudo' => 'required'
        ];
    }

    public function GetValidadorAtualizacao($request, $id){
        $validadores = $this->GetValidadorCadastro($request);
        $validadores['slug'] = [ 'max:300', Rule::unique('termos_aceite')->ignore($id) ];
        $validadores['conteudo'] = '';
        return $validadores;
    }

    public function NormalizaDados(&$dados, $atualizacao = false){
        $existeNome = array_key_exists('nome', $dados);
        $existeSlug = array_key_exists('slug', $dados);
        if(!$existeSlug and $existeNome and !$atualizacao) {
            $dados['slug'] = Strings::slugify($dados['nome']);
        }
    }
}