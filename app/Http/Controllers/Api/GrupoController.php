<?php

namespace App\Http\Controllers\Api;

use App\Models\Bases\IAPIController;
use App\Models\Grupo;

/**
 * @group Grupo de Usuários
 *
 * Endponits para gestão de grupos de usuários
 */
class GrupoController extends BaseAPIController implements IAPIController
{
    function __construct(){
        parent::__construct(Grupo::class);
    }
}
