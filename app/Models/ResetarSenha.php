<?php
namespace App\Models;

use App\Jobs\JobEnvioEmail;
use App\Models\Bases\BaseModel;
use App\Utils\BaseRetornoApi;
use App\Utils\EnvConfig;
use App\Utils\RandomStringUrl;
use Carbon\Carbon;

Class ResetarSenha extends BaseModel{
    protected $table = 'resete_senha';
    protected $fillable = [
        'id', 'usuario_id', 'token_resetar', 'utilizado'
    ];
    public static $tempoVidaToken = 1;

    private static function DesativaTokens($usuario_id, $tempo = 1){
        $tempo =  (intval($tempo) <= 0) ?  static::$tempoVidaToken : intval($tempo);
        $consulta = ResetarSenha::withTrashed()
            ->where('usuario_id', '=', $usuario_id)
            ->where('utilizado', '=', false);
        $consulta = $consulta
            ->where('created_at', '<=', Carbon::now()->subHours($tempo));
        $consulta->update(['utilizado' => true]);
    }

    public static function ResetarSenha($dados){
        if(!array_key_exists('email', $dados)){
            $msg = "É necessário informar o email";
            return BaseRetornoApi::GetRetornoErro([$msg], $msg);
        }
        $user = User::query()
            ->where('email', 'ilike', $dados['email'])
            ->first(['id', 'name', 'email']);
        if(!$user){
            return BaseRetornoApi::GetRetorno404("O Email informado não existe");
        }
        static::DesativaTokens($user->id, static::$tempoVidaToken);
        $token = RandomStringUrl::GenerateRandomString(100);
        $id = ResetarSenha::create(Array(
            'usuario_id' => $user->id,
            'token_resetar' => $token,
            'utilizado'=> false
        ))->id;
        if($id){
            $dados = Array(
                'nome' => $user->name,
                'email' => $user->email,
                'link_alterar_senha' => route('Resetar_senha_web', $token)
            );
            JobEnvioEmail::dispatch( ResetSenha::class, $user->email, $dados)
                ->afterResponse()
                ->onQueue('emails');
            return BaseRetornoApi::GetRetornoSucesso("Um email será enviado com instruções para resetar sua senha");
        }
        return BaseRetornoApi::GetRetornoErro(["Não foi possível criar o registro de alteração de senha"]);
    }

    public static function RegistraResetarSenha($dados){
        $resete = ResetarSenha::query()
            ->where('token_resetar', '=', $dados['token'])
            ->where('utilizado', '=', false)
            ->first();
        if(!$resete){
            return BaseRetornoApi::GetRetornoErro([], "Token para resetar expirado. Tente novamente");
        }
        if(strcmp($dados['senha'], $dados['resenha']) != 0){
            return BaseRetornoApi::GetRetornoErro([], "As senhas não coincidem.");
        }
        $usuario = User::query()
            ->where('id', '=', $resete->usuario_id)->first();
        $usuario->password = hash(EnvConfig::HashSenha(), $dados['senha']);
        $usuario->save();
        $resete->utilizado = true;
        $resete->save();
        static::DesativaTokens($usuario->id);
        return BaseRetornoApi::GetRetornoSucesso("Senha alterada com sucesso");
    }
}