<?php

namespace App\Http\Controllers\Web\admin;

use App\Http\Controllers\Web\admin\BaseAdminController;
use App\Models\Contatos;

class ContatosAdminController extends BaseAdminController{
    public function __construct(){
        parent::__construct(Contatos::class, 
            'admin.Contatos.index',
            'admin.Contatos.novo',
            'admin.Contatos.edita',
        );
    }
}