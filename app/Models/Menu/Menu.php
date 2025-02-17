<?php
namespace App\Models\Menu;

use App\Models\Bases\BaseModel;
use Illuminate\Support\Facades\DB;

Class Menu extends BaseModel{
    protected $table = 'menus';
    protected $fillable = [
        'id', 'nome', 'path', 'icone', 'parent_id', 'ordem'
    ];

    public function GetLikeFields(){
        return [
            'nome'
        ];
    }

    public function GetValidadorCadastro($request){
        return [
            'nome' => 'required|max:200',
            'path' => 'required|max:200',
            'icone' => 'required|max:200'
        ];
    }
    
    public static function ObtemMenusView($usuario_id = null){
        $menus = [];
        $filtro = " where 1=1 ";
        $inner = " left ";
        $complmentoUser = "";
        if(!is_null($usuario_id)){
            $filtro = " and usuario_grupo.usuario_id = '{$usuario_id}'";
            $inner = " inner ";
            $complmentoUser = " and sub.id in (select id from menusAcesso) ";
        }
        $dbMenus = DB::select("WITH menusAcesso as (
            select 
                menus.id
            From menus
            {$inner} join grupo_menu ON grupo_menu.menu_id = menus.id and grupo_menu.deleted_at is null
            left join usuario_grupo on grupo_menu.grupo_id = usuario_grupo.grupo_id and usuario_grupo.deleted_at is null
            {$filtro}
            and menus.deleted_at is null
            group by menus.id
        )
        select 
            menus.id,
            menus.nome,
            menus.icone,
            menus.path,
            menus.ordem,
            sub.id as sub_id,
            sub.nome as sub_nome,
            sub.icone as sub_icone,
            sub.path as sub_path,
            sub.ordem as sub_ordem
        From menus
        left join menus as sub on sub.parent_id = menus.id and sub.deleted_at is null {$complmentoUser}
        {$inner} join menusAcesso on menusAcesso.id = menus.id
        where menus.parent_id is null
        and menus.deleted_at is null
        order by menus.ordem, sub.ordem");
        foreach($dbMenus as $bdmenu){
            if(!array_key_exists($bdmenu->id, $menus)){
                $menus[$bdmenu->id] = [
                    "id" => $bdmenu->id,
                    "nome" => $bdmenu->nome,
                    "icone" => $bdmenu->icone,
                    "path" => $bdmenu->path,
                    "ordem" => $bdmenu->ordem,
                    "submenus" => []
                ];
            }
            if(!is_null($bdmenu->sub_id)){
                $menus[$bdmenu->id]['submenus'][] = [
                    "id" => $bdmenu->sub_id,
                    "nome" => $bdmenu->sub_nome,
                    "icone" => $bdmenu->sub_icone,
                    "path" => $bdmenu->sub_path,
                    "ordem" => $bdmenu->sub_ordem
                ];
            }
        }
        $menus = array_values($menus);
        return $menus;
    }
}