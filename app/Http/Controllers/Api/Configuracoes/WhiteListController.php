<?php

namespace App\Http\Controllers\Api\Configuracoes;

use App\Http\Controllers\Api\BaseAPIController;
use App\Models\Bases\IAPIController;
use App\Models\Configuracoes\WhiteList;

class WhiteListController extends BaseAPIController implements IAPIController{
    function __construct(){
        parent::__construct(WhiteList::class);
    }
}