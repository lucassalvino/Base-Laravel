<?php

namespace App\Models;

use App\Models\Bases\BaseModelAuthenticatable;
use App\Models\Enuns\Sexo;
use App\Utils\ArquivosStorage;
use App\Utils\EnvConfig;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
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
            'sexo' => 'required|max:100',
            'data_nascimento' => 'date'
        ];
    }

    public function GetValidadorAtualizacao($request, $id){
        $validacao = $this->GetValidadorCadastro($request);
        $validacao['username'] = ['required', 'max:255', Rule::unique('users')->ignore($id)];
        $validacao['email'] = ['required', 'max:255', Rule::unique('users')->ignore($id)];
        return $validacao;
    }

    public function NormalizaDados(&$dados, $atualizacao = false){
        $existeSexo = array_key_exists('sexo', $dados);
        if(!$existeSexo || ($existeSexo)){
            $dados['sexo'] = Sexo::NaoDefinido;
        }
        if(array_key_exists('password', $dados) && !$atualizacao){
            if(($atualizacao && strcasecmp('', $dados['password']) != 0) || (!$atualizacao)){
                $dados['password'] = hash(EnvConfig::HashSenha(), $dados['password']);
            }
        }
        if(!$atualizacao){
            $dados['path_avatar'] = static::$pathAvatarPadrao;
            if(!array_key_exists('username', $dados) && array_key_exists('email', $dados)){
                $dados['username'] = $dados['email'];
            }
        }
    }

    public static function ObtemElementoUnico($id){
        $retorno = parent::ObtemElementoUnico($id);
        if($retorno){
            $retorno->path_avatar = ArquivosStorage::GetUrlView($retorno->path_avatar);
        }
        return $retorno;
    }

    public static function CadastraElementoArray($dados){
        DB::beginTransaction();
        try{
            $nomeArquivo = "";
            if(array_key_exists('avatar_base_64', $dados) && array_key_exists('tipo_imagem_avatar', $dados)){
                $nomeArquivo = self::SalvaImagem($dados['avatar_base_64'], $dados['tipo_imagem_avatar']);
                if($nomeArquivo)
                    $dados['path_avatar'] = $nomeArquivo;
            }
            $cadastro = parent::CadastraElementoArray($dados);
            if(static::CheckIfIsValidator($cadastro)){
                if(strcasecmp("", $nomeArquivo) != 0){// a imagem do usuário foi salva
                    ArquivosStorage::DeletaArquivo($nomeArquivo);
                }
                return static::GeraErro($cadastro);
            }
            DB::commit();
            return $cadastro;
        }
        catch(Exception $erro){
            Log::error($erro);
            return static::GeraErro([$erro->getMessage()]);
        }
    }

    public static function AtualizaElementoArray($dados, &$instanciaBanco){
        DB::beginTransaction();
        try{
            $nomeArquivo = "";
            if(array_key_exists('sexo', $dados) || !Str::isUuid($dados['sexo'])){
                $dados['sexo'] = $instanciaBanco->sexo;
            }
            if(array_key_exists('avatar_base_64', $dados) && array_key_exists('tipo_imagem_avatar', $dados)){
                $nomeArquivo = self::SalvaImagem(
                    $dados['avatar_base_64'],
                    $dados['tipo_imagem_avatar'],
                    $instanciaBanco->id
                );
                if($nomeArquivo)
                    $dados['path_avatar'] = $nomeArquivo;
            }else{
                $dados['path_avatar'] = $instanciaBanco->path_avatar;
            }
            if(array_key_exists('password', $dados) && (strcasecmp('', $dados['password']) != 0)){
                $dados['password'] = hash(EnvConfig::HashSenha(), $dados['password']);
            }else{
                $dados['password'] = $instanciaBanco->password;
            }
            $cadastro = parent::AtualizaElementoArray($dados, $instanciaBanco);
            if(static::CheckIfIsValidator($cadastro)){
                if(strcasecmp("", $nomeArquivo) != 0){// a imagem do usuário foi salva
                    ArquivosStorage::DeletaArquivo($nomeArquivo);
                }
                return static::GeraErro($cadastro);
            }
            DB::commit();
            return $cadastro;
        }
        catch(Exception $erro){
            Log::error($erro);
            return static::GeraErro([$erro->getMessage()]);
        }
    }
}
