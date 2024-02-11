<?php

namespace App\Http\Controllers\Web\admin;

use App\Http\Controllers\Web\admin\BaseAdminController;
use App\Models\DuvidasFrequentes;

class DuvidasFrequentesAdminController extends BaseAdminController{
    public function __construct(){
        parent::__construct(DuvidasFrequentes::class, 
            'admin.cms.DuvidasFreq.index',
            'admin.cms.DuvidasFreq.novo',
            'admin.cms.DuvidasFreq.edita',
        );
    }
}