<?php
namespace App\Http\Controllers\Configuracoes;

use App\Http\Controllers\Controller;
use App\Models\Configuracoes\TokensAPI;
use App\Servicos\LoginServico;
use App\Utils\BaseRetornoApi;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ApiIntegracoesController extends Controller{
    public function Index(Request $request){
        $items = TokensAPI::ListagemElemento($request);
        return view('configs.TokensAPI.index', compact('items'));
    }

    public function Cadastro(Request $request, $id){
        $tokenapi = null;
        $tokenAleatorio = null;
        if(strcasecmp($id, TokensAPI::$guidempty) != 0){
            $tokenapi = TokensAPI::query()
                ->where('id', '=', $id)
                ->first();
        }else{
            $tokenAleatorio = hash('sha256', ((string) Str::uuid()));
        }
        $usuarios = LoginServico::ObtemUsuariosAdministradores();;
        return view('configs.TokensAPI.cadastro', compact('usuarios', 'tokenapi', 'tokenAleatorio'));
    }

    public function SalvaConfiguracaoAPI(Request $request){
        try{
            $id = $request->get('id', TokensAPI::$guidempty);
            if(strcasecmp($id, TokensAPI::$guidempty) == 0){
                return TokensAPI::CadastraElemento($request);
            }else{
                return TokensAPI::AtualizaElemento($request, $request->get('id'));
            }
        }catch(Exception $erro){
            return BaseRetornoApi::GetRetornoErroException($erro);
        }
    }
}