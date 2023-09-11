<?php

namespace App\Http\Controllers\Web\admin\Configuracoes;

use App\Http\Controllers\Web\admin\BaseAdminController;
use App\Models\Configuracoes\WhiteList;
use App\Models\Enuns\TipoWhiteList;

class WhiteListController extends BaseAdminController{
    public function __construct(){
        parent::__construct(WhiteList::class, 
            'admin.pages.Configuracoes.WhiteList.index',
            'admin.pages.Configuracoes.WhiteList.novo',
            'admin.pages.Configuracoes.WhiteList.edita'
        );
    }
    
    public function ObtemItensViewNovo(){
        return Array(
            'tipos' => TipoWhiteList::GetAllEnum()
        );
    }
}