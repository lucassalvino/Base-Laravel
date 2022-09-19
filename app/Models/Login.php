<?php
namespace App\Models;

use App\Models\Bases\BaseModel;
use App\Utils\ArquivosStorage;
use App\Utils\BaseRetornoApi;
use App\Utils\EnvConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Login extends BaseModel{
    protected $table = 'login';
    protected $fillable = [
        'id', 'api_token', 'user_id', 'codigo_verificacao_login', 'validado'
    ];

    public static function LogoutToken($token){
        $sessao = self::query()->where('api_token', '=', $token)->first();
        if($sessao)
            $sessao->delete();
        return BaseRetornoApi::GetRetornoSucesso("Usuário Deslogado");
    }

    public static function Logout(Request $request){
        $token = $request->header('Authorization');
        return static::LogoutToken($token);
    }

    public static function ValidaCodigoVerificacao(Request $request, $codigo){
        $token = $request->header('Authorization');
        $sessao = self::query()->where('api_token', '=', $token)->first();
        if ($sessao){
            if(strcmp($sessao->codigo_verificacao_login, $codigo) == 0){
                $sessao->validado = true;
                $sessao->save();
                return BaseRetornoApi::GetRetornoSucesso("Código de verificação validado");
            }else{
                return BaseRetornoApi::GetRetornoErro(["Código informado é inválido"], "Tente novamente", 403);
            }
        }else{
            return BaseRetornoApi::GetRetornoErro(["Não possui header 'Authorization' válido"], "Realize login antes de validar o código de verificação");
        }
    }

    public static function Get(Request $request){
        $token = $request->header('Authorization');
        return self::query()->where('api_token', '=', $token)->first([
            'id', 'api_token', 'validado'
        ]);
    }

    private static function VerificaSessoesAtivas($userId){
        $sessoes = self::query()->where('user_id','=',$userId)->orderBy('created_at')->get();
        if(isset($sessoes) && count($sessoes) >= EnvConfig::QtdSessaoPorUsuario()){
            $qtdRemover = count($sessoes) - EnvConfig::QtdSessaoPorUsuario() + 1;
            for($i = 0; $i<$qtdRemover; $i++){
                $sessoes[$i]->delete();
            }
        }
    }

    public static function Login(Request $request){
        $usuario = "";
        $senha = "";

        if(isset($request['user'])){
            $usuario = $request['user']; 
        }

        if(isset($request['password'])){
            $senha = $request['password'];
        }
        
        $senha = hash(EnvConfig::HashSenha(), $senha);
        
        $usuarioLogado = User::query()
            ->where(function($query) use ($usuario){
                return $query
                    ->where('email','=',$usuario)
                    ->orWhere('username','=',$usuario);
            })
            ->where('password', '=', $senha)
            ->first();

        if(isset($usuarioLogado) && $usuarioLogado && $usuarioLogado->id){
            $token = hash(EnvConfig::HashTokenApi(), Str::random(60));
            $codigoverificacao = Str::random(5);
            self::VerificaSessoesAtivas($usuarioLogado->id);
            $loginId = self::create(Array(
                "api_token"=> $token,
                "user_id" => $usuarioLogado->id,
                "codigo_verificacao_login" => $codigoverificacao,
            ))->id;
            if($loginId){
                return response()->json([
                    BaseRetornoApi::$CampoMensagem => "Usuário Logado com sucesso",
                    "api_token" => $token,
                    BaseRetornoApi::$codigoRetorno => 200,
                    BaseRetornoApi::$CampoErro => false,
                    "path_avatar" => ArquivosStorage::GetUrlView($usuarioLogado->path_avatar),
                    "name" => $usuarioLogado->name,
                    "userName" => $usuarioLogado->username,
                    "email" => $usuarioLogado->email,
                    "user_id" => $usuarioLogado->id
                ], 200);
            }else{
                return BaseRetornoApi::GetRetornoErro(
                    ["Falha ao gravar registro de login"],
                    "Falha ao criar registro de login",
                    500
                );
            }
        }else{
            return BaseRetornoApi::GetRetornoLoginIncorreto([]);
        }
    }
}