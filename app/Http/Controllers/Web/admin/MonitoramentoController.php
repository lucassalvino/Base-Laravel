<?php
namespace App\Http\Controllers\Web\admin;

use App\Models\Login;
use App\Servicos\LoginServico;
use App\Utils\BaseRetornoApi;
use Illuminate\Http\Request;

class MonitoramentoController extends BaseAdminController{
    public function Cache(Request $request){
        return view('admin.pages.Monitoramento.cache');
    }
}
