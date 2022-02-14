<?php

namespace App\Http\Controllers\Web\admin\Usuarios;

use App\Http\Controllers\Web\admin\BaseAdminController;
use App\Models\Grupo;

class GrupoController extends BaseAdminController{
    public function __construct(){
        parent::__construct(Grupo::class, 
            'admin.pages.Usuarios.Grupos.index',
            'admin.pages.Usuarios.Grupos.novo',
            'admin.pages.Usuarios.Grupos.edita',
        );
    }
}