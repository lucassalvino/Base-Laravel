<?php

namespace App\Http\Controllers\Web\admin\Categorizadores;

use App\Http\Controllers\Web\admin\BaseAdminController;
use App\Models\Categorizadores\Especialidades;

class EspecialidadesController extends BaseAdminController{
    public function __construct(){
        parent::__construct(Especialidades::class,
            'admin.pages.Categorizadores.Especialidade.index',
            'admin.pages.Categorizadores.Especialidade.novo'
        );
    }
}