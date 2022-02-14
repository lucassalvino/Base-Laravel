<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseAPIController;
use App\Models\Bases\IAPIController;
use App\Models\Consulta;

/**
 * @group Consulta
 *
 * Endponits para gestão de Consulta
 */
class ConsultaController extends BaseAPIController implements IAPIController
{
    function __construct(){
        $this->class = new Consulta();
    }
}