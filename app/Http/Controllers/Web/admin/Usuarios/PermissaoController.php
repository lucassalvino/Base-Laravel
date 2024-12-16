<?php

namespace  App\Http\Controllers\Web\admin\Usuarios;

use App\Http\Controllers\Web\admin\BaseAdminController;
use App\Models\Grupo;
use App\Models\Menu\GrupoMenu;
use App\Models\Relacionamentos\UsuarioGrupo;
use App\Servicos\LoginServico;
use App\Utils\BaseRetornoApi;
use Illuminate\Http\Request;

class PermissaoController extends BaseAdminController
{
    public function Index(Request $request){
        $itensIndex = Grupo::ListagemElemento($request);
        return view('admin.pages.Usuarios.Permissoes.index', compact('itensIndex'));
    }

    public function MenusGrupo(Request $request){
        $itensIndex = Grupo::ListagemElemento($request);
        return view('admin.pages.Usuarios.Permissoes.Menus.index', compact('itensIndex'));
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

    public function MenusGrupoEdicao(Request $request, $id){
        $grupo = Grupo::query()->where('id', '=', $id)->first();
        $menusGrupos = GrupoMenu::query()
            ->join('menus', 'menus.id', '=', 'grupo_menu.menu_id')
            ->where('grupo_menu.grupo_id', '=',  $id)
            ->paginate(20, [
                'menus.id as menu_id',
                'grupo_menu.grupo_id',
                'menus.nome as nome_menu'
            ]);
        return view('admin.pages.Usuarios.Permissoes.Menus.editamenu', compact('grupo', 'menusGrupos'));
    }

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
        LoginServico::CriaRegistrosPadraoGrupo($dados['usuario_id'], $dados['grupo_id']);
        return BaseRetornoApi::GetRetornoSucesso("");
    }

    public function AdicionamenuGrupo(Request $request){
        $dados = $request->all();
        $registro = GrupoMenu::withTrashed()
            ->where('grupo_id', '=', $dados['grupo_id'])
            ->where('menu_id', '=', $dados['menu_id'])
            ->first();
        if($registro){
            if($registro->trashed()){
                $registro->restore();
                $registro->save();
            }
        }else{
            GrupoMenu::create(Array(
                'grupo_id' => $dados['grupo_id'],
                'menu_id' => $dados['menu_id']
            ));
        }
        return BaseRetornoApi::GetRetornoSucesso("");
    }

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

    public function RemoverMenuGrupo(Request $request){
        $dados = $request->all();
        $registro = GrupoMenu::query()
            ->where('grupo_id', '=', $dados['grupo_id'])
            ->where('menu_id', '=', $dados['menu_id'])
            ->first();
        if($registro){
            $registro->delete();
            $registro->save();
        }
        return BaseRetornoApi::GetRetornoSucesso("");
    }
}
