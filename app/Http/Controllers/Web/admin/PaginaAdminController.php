<?php

namespace App\Http\Controllers\Web\admin;

use App\Http\Controllers\Web\admin\BaseAdminController;
use App\Models\CMS\Pagina;
use App\Models\Enuns\StatusPagina;
use App\Servicos\PaginaServico;
use Illuminate\Http\Request;

class PaginaAdminController extends BaseAdminController{
    public function __construct(){
        parent::__construct(Pagina::class, 
            'admin.cms.Pagina.index',
            'admin.cms.Pagina.novo',
            'admin.cms.Pagina.edita',
        );
    }

    public function ObtemItensViewNovo(){
        return Array(
            'status' => StatusPagina::GetAllEnum()
        );
    }

    public function ViewPagina(Request $request, $slug){
        $pagina = PaginaServico::ObtemPagina($slug);
        if(!$pagina){
            abort(404);
        }
        return view('pagina', compact('pagina'));
    }
}