<?php

namespace App\Http\Controllers\Web\admin\Carteira;

use App\Http\Controllers\Web\admin\BaseAdminController;
use App\Models\Carteira\Carteira;
use App\Models\Carteira\CarteiraMovimentacao;
use Illuminate\Http\Request;

class CarteirasController extends BaseAdminController{
    public function __construct(){
        parent::__construct(
            Carteira::class,
            'admin.pages.Carteira.index'
        );
    }

    public static function Movimentacoes(Request $request, $carteira_id){
        $request = $request->merge(['carteira_id' => $carteira_id]);
        $itensIndex = CarteiraMovimentacao::ListagemElemento($request);
        $carteira = Carteira::ObtemViewCarteira($carteira_id);
        if(!$carteira)
            abort(404);
        return view('admin.pages.Carteira.movimentacoes', compact('itensIndex', 'carteira'));
    }
}
