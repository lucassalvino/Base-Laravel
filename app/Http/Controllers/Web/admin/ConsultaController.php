<?php

namespace App\Http\Controllers\Web\admin;

use App\Http\Controllers\Web\admin\BaseAdminController;
use App\Models\Consulta;

class ConsultaController extends BaseAdminController{
    public function __construct(){
        parent::__construct(Consulta::class,
            'admin.pages.Consulta.index'
        );
    }
}