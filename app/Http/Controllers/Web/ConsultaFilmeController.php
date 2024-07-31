<?php
namespace App\Http\Controllers\Web;

use App\Models\Login;
use App\Servicos\LoginServico;
use App\Utils\BaseRetornoApi;
use Illuminate\Http\Request;

class ConsultaFilmeController extends BaseWebController{

    public function ConsultarFilme(Request $request){
        $filmes = json_decode($request->input('search'), true);
        
        return view('publico.filmes', compact('filmes'));
    }
    
}
