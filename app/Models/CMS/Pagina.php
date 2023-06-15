<?php
namespace App\Models\CMS;

use App\Models\Bases\BaseModel;
use App\Models\Enuns\StatusPagina;
use App\Rules\ValidaEnum;
use App\Utils\ArquivosStorage;
use App\Utils\Strings;
use Illuminate\Validation\Rule;

Class Pagina extends BaseModel{
    protected $table = 'pagina';
    protected $fillable = [
        'id', 'titulo', 'slug', 'status', 'conteudo', 'resumo',
        'meta', 'parent_id', 'usuario_id', 'thumbnail'
    ];

    public function GetLikeFields(){
        return [
            'titulo', 'slug', 'resumo', 'status'
        ];
    }

    public function GetValidadorCadastro($request){
        return [
            'titulo' => 'required|max:300',
            'slug' => 'required|max:300|unique:pagina',
            'conteudo' => 'required',
            'status' => ['required', 'max:50', new ValidaEnum(StatusPagina::class)],
            'usuario_id' => 'required|exists:users,id'
        ];
    }

    public function GetValidadorAtualizacao($request, $id){
        $validadores = $this->GetValidadorCadastro($request);
        $validadores['slug'] = [ 'max:300', Rule::unique('pagina')->ignore($id) ];
        $validadores['usuario_id'] = [ 'exists:users,id' ];
        $validadores['conteudo'] = '';
        return $validadores;
    }

    public function NormalizaDados(&$dados, $atualizacao = false){
        $existeNome = array_key_exists('titulo', $dados);
        $existeSlug = array_key_exists('slug', $dados);
        if(!$existeSlug and $existeNome and !$atualizacao) {
            $dados['slug'] = Strings::slugify($dados['titulo']);
        }

        if(array_key_exists('thumbnail_base64', $dados) && array_key_exists('thumbnail_type', $dados)){
            $nomeArquivo = static::SalvaImagem($dados['thumbnail_base64'], $dados['thumbnail_type']);
            if($nomeArquivo){
                $dados['thumbnail'] = $nomeArquivo;
            }
        }

        if(isset($dados['sessao']['user_id']) && !$atualizacao){
            $dados['usuario_id'] = $dados['sessao']['user_id'];
        }
    }

    public static function ObtemElementoUnico($id){
        $retorno = parent::ObtemElementoUnico($id);
        if($retorno){
            $retorno->thumbnail = ArquivosStorage::GetUrlView($retorno->thumbnail);
        }
        return $retorno;
    }
}