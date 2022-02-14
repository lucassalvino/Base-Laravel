<?php

namespace App\Http\Controllers\Api\Categorizadores;

use App\Http\Controllers\Api\BaseAPIController;
use App\Models\Bases\IAPIController;
use App\Models\Categorizadores\TipoDocumento;

/**
 * @group Tipo Documento
 *
 * Endponits para gestão de sexo
 */
class TipoDocumentoController extends BaseAPIController implements IAPIController
{
    function __construct()
    {
        $this->class = new TipoDocumento();
    }
}