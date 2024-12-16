<?php

namespace Database\Seeders;

use App\Models\Menu\Menu;
use Illuminate\Database\Seeder;

class MenusSeeders extends Seeder {
    function CriaArvoreMenu($menu, $parent_id = null){
        $menuAt = Menu::query()
            ->where('nome', '=', $menu['nome'])
            ->where('path', '=', $menu['path'])
            ->first();
        if(!$menuAt){
            $menuAt = Menu::create([
                'nome' => $menu['nome'],
                'path' => $menu['path'],
                'icone' => $menu['icone'],
                'ordem' => $menu['ordem'],
                'parent_id' => $parent_id
            ]);
        }
        if(array_key_exists('submenus', $menu) && is_array($menu['submenus'])){
            foreach($menu['submenus'] as $submenu){
                $this->CriaArvoreMenu($submenu, $menuAt->id);
            }
        }
    }

    public function run(){
        $menus = [
            [
                'nome' => 'Dashboard', 
                'path' => "#",
                'icone' => 'nav-icon bi bi-speedometer',
                'ordem' => 0,
                'submenus' => [
                    [
                        'nome' => 'Status', 
                        'path' => "/painel",
                        'icone' => 'nav-icon bi bi-circle-fill',
                        'ordem' => 0,
                    ]
                ]
            ]
        ];

        foreach($menus as $menu){
            $this->CriaArvoreMenu($menu, null);
        }
    }
}
