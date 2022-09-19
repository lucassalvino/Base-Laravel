<?php

namespace App\Http\Controllers\Web\admin\Usuarios;

use App\Http\Controllers\Web\admin\BaseAdminController;
use App\Models\Enuns\Sexo;
use App\Models\User;

class UsuarioController extends BaseAdminController{
    public function __construct(){
        parent::__construct(User::class, 
            'admin.pages.Usuarios.Usuarios.index',
            'admin.pages.Usuarios.Usuarios.novo',
            'admin.pages.Usuarios.Usuarios.edita',
        );
    }
    
    public function ObtemItensViewNovo(){
        return Array(
            'sexo' => Sexo::GetAllEnum()
        );
    }
}