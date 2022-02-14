<?php

namespace App\Http\Controllers\Api\Categorizadores;

use App\Http\Controllers\Api\BaseAPIController;
use App\Models\Bases\IAPIController;
use App\Models\Categorizadores\Sexo;

/**
 * @group Sexo
 *
 * Endponits para gestão de sexo
 */
class SexoController extends BaseAPIController implements IAPIController
{
    function __construct(){
        $this->class = new Sexo();
    }
}