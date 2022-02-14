<?php

namespace App\Http\Controllers\Web\admin\Categorizadores;

use App\Http\Controllers\Web\admin\BaseAdminController;
use App\Models\Categorizadores\Sexo;

class SexoController extends BaseAdminController{
    public function __construct(){
        parent::__construct(Sexo::class,
            'admin.pages.Categorizadores.Sexo.index'
        );
    }
}