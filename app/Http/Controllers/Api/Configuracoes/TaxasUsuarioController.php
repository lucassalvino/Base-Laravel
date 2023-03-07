<?php

namespace App\Http\Controllers\Api\Configuracoes;

use App\Http\Controllers\Api\BaseAPIController;
use App\Models\Bases\IAPIController;
use App\Models\Produtor\UsuarioTaxa;

class TaxasUsuarioController extends BaseAPIController implements IAPIController{
    function __construct(){
        parent::__construct(UsuarioTaxa::class);
    }
}