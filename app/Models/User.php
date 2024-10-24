<?php

namespace App\Models;

use App\Models\Bases\BaseModelAuthenticatable;
use App\Models\Enuns\Sexo;
use App\Models\Pessoa\Documento;
use App\Models\Pessoa\Endereco;
use App\Models\Pessoa\Telefone;
use App\Rules\ValidaEnum;
use App\Utils\ArquivosStorage;
use App\Utils\AuxCarbon;
use App\Utils\Strings;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;

class User extends BaseModelAuthenticatable{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    protected $table = "users";
    public static $pathAvatarPadrao = "imagens/c7ae38b4_1280_4e19_9fcb_c6c8b557ae3c.png";

    protected $fillable = [
        'id',
        'name',
        'username',
        'email',
        'password',
        'path_avatar',
        'sexo',
        'data_nascimento'
    ];

    public function GetLikeFields(){
        return [
            'name', 'username', 'email'
        ];
    }

    protected $hidden = [
        'password'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function GetValidadorCadastro($request){
        return [
            'name' => 'required|max:255',
            'username' => 'required|max:255|unique:users',
            'email' => 'required|max:255|unique:users',
            'path_avatar' => 'required|max:300',
            'password' => 'required|max:300',
            'sexo' => ['required', 'max:100', new ValidaEnum(Sexo::class)],
            'data_nascimento' => 'date'
        ];
    }

    public function GetValidadorAtualizacao($request, $id){
        $validacao = $this->GetValidadorCadastro($request);
        $validacao['username'] = ['required', 'max:255', Rule::unique('users')->ignore($id)];
        $validacao['email'] = ['required', 'max:255', Rule::unique('users')->ignore($id)];
        $validacao['password'] = ['max:300'];
        $validacao['path_avatar'] = ['max:300'];
        $validacao['sexo'] = ['max:100', new ValidaEnum(Sexo::class)];
        return $validacao;
    }

    public function NormalizaDados(&$dados, $atualizacao = false){
        if(!array_key_exists('sexo', $dados)){
            $dados['sexo'] = Sexo::NaoDefinido;
        }

        if(array_key_exists('data_nascimento', $dados) && (!Strings::isNullOrEmpty($dados['data_nascimento']))){
            $data = AuxCarbon::ObtenhaDataBanco($dados['data_nascimento']);
            if(Strings::isNullOrEmpty($data)){
                $data = AuxCarbon::ObtenhaDataBanco($dados['data_nascimento'], 'Y-m-d');
            }
            $dados['data_nascimento'] = $data;
        }

        if(!$atualizacao){
            $dados['path_avatar'] = static::$pathAvatarPadrao;
            if(!array_key_exists('username', $dados) && array_key_exists('email', $dados)){
                $dados['username'] = $dados['email'];
            }

            if(!array_key_exists('password', $dados)){
                $dados['password'] = "Mudar@1234!";
            }
        }

        if(array_key_exists('base_path_avatar', $dados) && array_key_exists('tipo_path_avatar', $dados)){
            $nomeArquivo = self::SalvaImagem($dados['base_path_avatar'], $dados['tipo_path_avatar']);
            if($nomeArquivo)
                $dados['path_avatar'] = $nomeArquivo;
        }
    }

    public static function ObtemElementoUnico($id){
        $retorno = parent::ObtemElementoUnico($id);
        if($retorno){
            $retorno->path_avatar = ArquivosStorage::GetUrlView($retorno->path_avatar);
            $retorno['documento'] = Documento::query()->where('usuario_id', '=', $id)->first();
            $retorno['endereco'] = Endereco::query()->where('usuario_id', '=', $id)->first();
            $retorno['telefone'] = Telefone::query()->where('usuario_id', '=', $id)->first();
        }
        return $retorno;
    }
}
