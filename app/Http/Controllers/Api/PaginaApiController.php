<?php

namespace App\Http\Controllers\Api;

use App\Models\Bases\IAPIController;
use App\Models\CMS\Pagina;

class PaginaApiController extends BaseAPIController implements IAPIController{
    function __construct(){
        parent::__construct(Pagina::class);
    }
}
