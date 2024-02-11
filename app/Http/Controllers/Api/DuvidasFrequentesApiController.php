<?php

namespace App\Http\Controllers\Api;

use App\Models\Bases\IAPIController;
use App\Models\DuvidasFrequentes;

class DuvidasFrequentesApiController extends BaseAPIController implements IAPIController{
    function __construct(){
        parent::__construct(DuvidasFrequentes::class);
    }
}
