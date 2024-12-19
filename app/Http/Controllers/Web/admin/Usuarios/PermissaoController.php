<?php

namespace  App\Http\Controllers\Web\admin\Usuarios;

use App\Http\Controllers\Web\admin\BaseAdminController;
use App\Models\Grupo;
use App\Models\Menu\GrupoMenu;
use App\Models\Menu\Menu;
use App\Models\Relacionamentos\UsuarioGrupo;
use App\Servicos\LoginServico;
use App\Utils\BaseRetornoApi;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            ->where('grupo_menu.grupo_id', '=',  $id)
            ->get([
                'grupo_menu.*'
            ]);
        $menus = Menu::ObtemMenusView();
        return view('admin.pages.Usuarios.Permissoes.Menus.editamenu', compact('grupo', 'menusGrupos', 'menus'));
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

    public function AtualizaMenuGrupo(Request $request){
        try{
            DB::beginTransaction();
            $menus = $request->get('menus', []);
            $grupoid = $request->get('grupo_id', null);
            GrupoMenu::withTrashed()
                ->where('grupo_id', '=', $grupoid)
                ->delete();
            foreach($menus as $menu){
                $registro = GrupoMenu::withTrashed()
                    ->where('grupo_id', '=', $grupoid)
                    ->where('menu_id', '=', $menu)
                    ->first();
                if($registro){
                    if($registro->trashed()){
                        $registro->restore();
                        $registro->save();
                    }
                }else{
                    GrupoMenu::create(Array(
                        'grupo_id' => $grupoid,
                        'menu_id' => $menu
                    ));
                }
            }
            DB::commit();
            return BaseRetornoApi::GetRetornoSucesso("");
        }catch(Exception $erro){
            DB::rollBack();
            return GrupoMenu::GeraErro([$erro->getMessage()]);
        }
    }
}
