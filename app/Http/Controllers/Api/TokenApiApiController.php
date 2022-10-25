<?php

namespace App\Http\Controllers\Api;

use App\Models\Bases\IAPIController;
use App\Models\Configuracoes\TokensAPI;


class TokenApiApiController extends BaseAPIController implements IAPIController{
    function __construct(){
        parent::__construct(TokensAPI::class);
    }
}
