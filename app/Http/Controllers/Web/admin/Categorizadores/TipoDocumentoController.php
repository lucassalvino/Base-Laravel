<?php

namespace App\Http\Controllers\Web\admin\Categorizadores;

use App\Http\Controllers\Web\admin\BaseAdminController;
use App\Models\Categorizadores\TipoDocumento;

class TipoDocumentoController extends BaseAdminController{
    public function __construct(){
        parent::__construct(TipoDocumento::class,
            'admin.pages.Categorizadores.TipoDocumento.index'
        );
    }
}