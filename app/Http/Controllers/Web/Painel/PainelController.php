<?php
namespace App\Http\Controllers\Web\Painel;

use App\Http\Controllers\Web\BaseWebController;
use Illuminate\Http\Request;

class PainelController extends BaseWebController{
    public function Home(Request $request){
        return view('Painel.Home');
    }
}
