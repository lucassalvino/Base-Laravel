<?php

namespace  App\Http\Controllers\Web\admin\Usuarios;

use App\Http\Controllers\Web\admin\BaseAdminController;
use App\Models\Grupo;
use App\Models\Relacionamentos\UsuarioGrupo;
use App\Utils\BaseRetornoApi;
use Illuminate\Http\Request;

class PermissaoController extends BaseAdminController
{
    public function Index(Request $request){
        $itensIndex = Grupo::ListagemElemento($request);
        return view('admin.pages.Usuarios.Permissoes.index', compact('itensIndex'));
    }

    public function UsuariosGrupo(Request $request, $id){
        $grupo = Grupo::query()->where('id', '=', $id)->first();
        $usuariosGrupos = UsuarioGrupo::query()
            ->join('users', 'users.id', '=', 'usuario_grupo.usuario_id')
            ->where('usuario_grupo.grupo_id', '=',  $id)
            ->paginate(20, [
                'users.id as usuario_id',
                'usuario_grupo.grupo_id',
                'users.name as nome_usuario'
            ]);
        return view('admin.pages.Usuarios.Permissoes.editausuarios', compact('grupo', 'usuariosGrupos'));
    }

    /**
     * @bodyParam grupo_id string
     * @bodyParam usuario_id string
     */
    public function AdicionaUsuarioGrupo(Request $request){
        $dados = $request->all();
        $registro = UsuarioGrupo::withTrashed()
            ->where('grupo_id', '=', $dados['grupo_id'])
            ->where('usuario_id', '=', $dados['usuario_id'])
            ->first();
        if($registro){
            if($registro->trashed()){
                $registro->restore();
                $registro->save();
            }
        }else{
            UsuarioGrupo::create(Array(
                'usuario_id' => $dados['usuario_id'],
                'grupo_id' => $dados['grupo_id']
            ));
        }
        return BaseRetornoApi::GetRetornoSucesso("");
    }

    /**
     * @bodyParam grupo_id string
     * @bodyParam usuario_id string
     */
    public function RemoverUsuarioGrupo(Request $request){
        $dados = $request->all();
        $registro = UsuarioGrupo::query()
            ->where('grupo_id', '=', $dados['grupo_id'])
            ->where('usuario_id', '=', $dados['usuario_id'])
            ->first();
        if($registro){
            $registro->delete();
            $registro->save();
        }
        return BaseRetornoApi::GetRetornoSucesso("");
    }
}
