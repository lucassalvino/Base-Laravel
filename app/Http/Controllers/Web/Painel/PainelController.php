<?php
namespace App\Http\Controllers\Web\Painel;

use App\Http\Controllers\Web\BaseWebController;
use App\Models\Enuns\Sexo;
use App\Models\User;
use Illuminate\Http\Request;

class PainelController extends BaseWebController{
    public function Home(Request $request){
        return view('Painel.Home');
    }
    
    public function MeuPerfil(Request $request){
        $sessao = $request->get('sessao');
        if(is_null($sessao)){
            return abort(404);
        }
        $item = User::ObtemElementoUnico($sessao['user_id']);
        $sexos = Sexo::GetAllEnum();
        return view('Painel.MeuPerfil', compact('item', 'sexos'));
    }
}
