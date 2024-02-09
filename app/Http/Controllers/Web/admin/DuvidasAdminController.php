<?php

namespace App\Http\Controllers\Web\admin;

use App\Http\Controllers\Web\admin\BaseAdminController;
use App\Models\CMS\TermosAceite;
use App\Models\Duvidas;

class DuvidasAdminController extends BaseAdminController{
    public function __construct(){
        parent::__construct(Duvidas::class, 
            'admin.cms.DuvidasFreq.index',
            'admin.cms.DuvidasFreq.novo',
            'admin.cms.DuvidasFreq.edita',
        );
    }
}