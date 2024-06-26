<?php

namespace App\Http\Controllers\Api;

use App\Models\Bases\IAPIController;
use App\Models\Contatos;

class ContatosAPIController extends BaseAPIController implements IAPIController{
    function __construct(){
        parent::__construct(Contatos::class);
    }
}
