<?php

namespace App\Http\Controllers\Api;

use App\Models\Bases\IAPIController;
use App\Models\CMS\TermosAceite;

class TermosAceiteAPIController extends BaseAPIController implements IAPIController{
    function __construct(){
        parent::__construct(TermosAceite::class);
    }
}
