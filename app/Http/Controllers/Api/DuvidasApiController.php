<?php

namespace App\Http\Controllers\Api;

use App\Models\Bases\IAPIController;
use App\Models\Duvidas;

class DuvidasApiController extends BaseAPIController implements IAPIController{
    function __construct(){
        parent::__construct(Duvidas::class);
    }
}
