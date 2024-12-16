<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Login;
use App\Models\Menu\Menu;
use App\Models\ResetarSenha;
use App\Models\User;
use App\Servicos\UsuarioServico;
use App\Utils\ApiCache;
use App\Utils\ArquivosStorage;
use Illuminate\Http\Request;

class LoginApiController extends Controller
{

    public function RealizaLogin(Request $request)
    {
        return Login::Login($request);
    }

    public function ResetarSenha(Request $request)
    {
        return ResetarSenha::ResetarSenha($request->all());
    }

    public function RegistraResetarSenha(Request $request)
    {
        return ResetarSenha::RegistraResetarSenha($request->all());
    }

    public function Logout(Request $request)
    {
        return Login::Logout($request);
    }

    public function ObtemDadosLogado(Request $request){
        $userid = $request['sessao']['user_id'];
        $chave = ApiCache::GeraChaveRequest(['LOGIN_DATA', $userid]);
        return ApiCache::ObtemDadosCache($chave, function() use($userid){
            $usuarioLogado = User::query()->where('id', '=', $userid)->first();
            $menus = Menu::ObtemMenusView($userid);
            $retorno = [
                "path_avatar" => ArquivosStorage::GetUrlView($usuarioLogado->path_avatar),
                "name" => $usuarioLogado->name,
                "email" => $usuarioLogado->email,
                "user_id" => $usuarioLogado->id,
                "menus" => $menus
            ];
            return $retorno;
        },
        4);
    }

    public function AlteraSenha(Request $request){
        return UsuarioServico::AlterarSenha($request);
    }
}
