<?php

namespace App\Http\Controllers\Web\admin;

use App\Http\Controllers\Web\admin\BaseAdminController;
use App\Models\CMS\TermosAceite;

class TermosAceiteController extends BaseAdminController{
    public function __construct(){
        parent::__construct(TermosAceite::class, 
            'admin.cms.TermosAceite.index',
            'admin.cms.TermosAceite.novo',
            'admin.cms.TermosAceite.edita',
        );
    }
}