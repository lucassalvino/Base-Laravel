<?php

namespace App\Http\Controllers\Api;

use App\Models\Bases\IAPIController;
use App\Models\Menu\Menu;

class MenusAPIController extends BaseAPIController implements IAPIController{
    function __construct(){
        parent::__construct(Menu::class);
    }
}
