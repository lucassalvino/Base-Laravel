<?php
namespace App\Servicos;
use App\Models\User;
use App\Utils\BaseRetornoApi;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuarioServico{
    function __construct() {
    }

    public static function ObtemUsuariosGrupo($slugGrupo){
        $sql = "SELECT users.id, users.name From users
        inner join usuario_grupo ON usuario_grupo.usuario_id = users.id
        inner join grupo on grupo.id = usuario_grupo.grupo_id
        where grupo.slug = '".$slugGrupo."'";
        return DB::select($sql);
    }

    public function CadastraUsuario(Request $request){
        try{
            return User::CadastraElemento($request);
        }catch(Exception $erro){
            return BaseRetornoApi::GetRetornoErroException($erro);
        }
    }

    public function Atualiza(Request $request, $id){
        return User::AtualizaElemento($request, $id);
    }

    public function Listagem(Request $request){
        return User::ListagemElemento($request);
    }

    public function Detalhado(Request $request, $id){
        return User::Detalhado($request, $id);
    }

    public function Deleta(Request $request, $id){
        return User::DeleteElemento($request, $id);
    }

    public function Restaura(Request $request, $id){
        return User::RestoreElemento($request, $id);
    }
}
