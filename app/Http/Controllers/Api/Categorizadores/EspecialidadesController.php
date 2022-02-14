<?php

namespace App\Http\Controllers\Api\Categorizadores;

use App\Http\Controllers\Api\BaseAPIController;
use App\Models\Bases\IAPIController;
use App\Models\Categorizadores\Especialidades;

/**
 * @group Especialidades
 *
 * Endponits para gestão de especialidades
 */
class EspecialidadesController extends BaseAPIController implements IAPIController
{
    function __construct(){
        $this->class = new Especialidades();
    }
}