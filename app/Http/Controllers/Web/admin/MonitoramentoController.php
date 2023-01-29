<?php
namespace App\Http\Controllers\Web\admin;

use App\Utils\ApiCache;
use App\Utils\BaseRetornoApi;
use Illuminate\Http\Request;

class MonitoramentoController extends BaseAdminController{
    public function Cache(Request $request){
        return view('admin.pages.Monitoramento.cache');
    }

    public function LimpaCache(Request $request){
        ApiCache::LimpaCahce();
        return BaseRetornoApi::GetRetornoSucesso("Solicitacao de limpeza de cache feita com sucesso");
    }
}
