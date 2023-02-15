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
        DB::beginTransaction();
        try{
            $cadastro = User::CadastraElemento($request);
            DB::commit();
        }catch(Exception $erro){
            return User::GeraErro($erro);
        }
    }

    public function Atualiza(Request $request, $id){
        DB::beginTransaction();
        try{
            return User::AtualizaElemento($request, $id);
            DB::commit();
        }catch(Exception $erro){
            return User::GeraErro($erro);
        }
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
