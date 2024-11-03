<?php
namespace App\Http\Controllers\Web;

use App\Models\Login;
use App\Servicos\LoginServico;
use App\Utils\BaseRetornoApi;
use Illuminate\Http\Request;

class PublicoController extends BaseWebController{

    public function login(Request $request){
        $token = session('Authorization', '');
        $sessao = LoginServico::ObtemSessao($token);
        if($sessao){
            return redirect()->route('painel:home.painel');
        }
        return view('publico.login');
    }

    public function RealizarLogin(Request $request){
        $login = Login::Login($request);
        if($login->original[BaseRetornoApi::$CampoErro]){
            return view('publico.login', Array('retorno' => $login->original));
        }else{
            $request->session()->put('Authorization', $login->original['api_token']);
            $request->session()->put('usuarioNome', $login->original['name']);
            $request->session()->put('usuarioEmail', $login->original['email']);
            $request->session()->put('usuarioAvatar', $login->original['path_avatar']);
            return redirect()->route('painel:home.painel');
        }
    }

    public function RealizarLogout(Request $request) {
        $token = session('Authorization', '');
        Login::LogoutToken($token);
        $request->session()->flush();
        return redirect()->route('site.login');
    }
}
