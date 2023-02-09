<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Login;
use App\Models\ResetarSenha;
use App\Models\User;
use App\Utils\ArquivosStorage;
use App\Utils\BaseRetornoApi;
use Illuminate\Http\Request;

/**
 * @group Autenticação
 *
 * Endponits para administrar os logins de usuário
 */
class LoginApiController extends Controller
{

    /**
     * Realiza login do usuário.
     *
     * @bodyParam   user    string  required     Identificador do usuário  Example: teste@teste.com.br
     * @bodyParam   password    string required   senha do usuário   Example: minha_senha
     *
     * @response {
     *  "mensagem": "Usuário Logado com sucesso",
     *   "api_token": "ab8b417439871f95f95c8b27000b331abb49a80397c977f9f3ba500558da7059",
     *   "codigoretorno": 200,
     *   "erro": false,
     *   "path_avatar": "http://localhost/public/resources/storage/imagens/1bab6d41_20cc_492e_b622_153a4f408f99.jpg",
     *   "name": "kame"
     * }
     */
    public function RealizaLogin(Request $request)
    {
        return Login::Login($request);
    }

    /**
     * Realiza solicitação de resetar a senha
     *
     * @bodyParam   email    string  required     Email do usuário que deseja resetar a senha  Example: teste@teste.com.br
     */
    public function ResetarSenha(Request $request)
    {
        return ResetarSenha::ResetarSenha($request->all());
    }

    /**
     * Altera senha do usuário via solicitação de resete de senha
     *
     * @bodyParam   token   string  required    Token de resete de senha, o usuário obtem este token ao solicitar resete de senha   Example: ftrjs1s23...
     * @bodyParam   senha   string  required    Nova senha a ser definida   Example: nova_senha
     * @bodyParam   resenha   string  required    Confirmação da senha   Example: nova_senha
     */
    public function RegistraResetarSenha(Request $request)
    {
        return ResetarSenha::RegistraResetarSenha($request->all());
    }

    /**
     * Desloga o usuário atual
     * @authenticated
     */
    public function Logout(Request $request)
    {
        return Login::Logout($request);
    }

    public function ObtemDadosLogado(Request $request){
        $usuarioLogado = User::query()->where('id', '=', $request['sessao']['user_id'])->first();
        return response()->json([
            BaseRetornoApi::$CampoMensagem => "Usuário Logado com sucesso",
            BaseRetornoApi::$codigoRetorno => 200,
            BaseRetornoApi::$CampoErro => false,
            "path_avatar" => ArquivosStorage::GetUrlView($usuarioLogado->path_avatar),
            "name" => $usuarioLogado->name,
            "email" => $usuarioLogado->email,
            "user_id" => $usuarioLogado->id,
            "user_name" => $usuarioLogado->username,
        ], 200);
    }
}
