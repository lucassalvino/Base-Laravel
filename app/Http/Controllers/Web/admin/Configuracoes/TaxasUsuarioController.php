<?php

namespace App\Http\Controllers\Web\admin\Configuracoes;

use App\Http\Controllers\Web\admin\BaseAdminController;
use App\Models\Produtor\UsuarioTaxa;
use App\Servicos\LoginServico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaxasUsuarioController extends BaseAdminController{
    public function __construct(){
        parent::__construct(UsuarioTaxa::class,
        'admin.pages.Taxas.index',
        '',
        'admin.pages.Taxas.edita');
    }

    private function ObtemUsuariosProdutores($todos = false){
        $sql = "SELECT users.id, users.name From users
        inner join usuario_grupo ON usuario_grupo.usuario_id = users.id
        inner join grupo on grupo.id = usuario_grupo.grupo_id
        where grupo.slug in ('".LoginServico::SlugProdutor."')";
        if(!$todos){
            $sql = $sql." and users.id not in (select usuario_id from usuario_taxa)";
        }
        return DB::select($sql);
    }

    public function ObtemItensViewNovo(){
        return Array(
            'usuarios' => static::ObtemUsuariosProdutores()
        );
    }

    public function ObtemItensViewEdita(){
        return Array(
            'usuarios' => static::ObtemUsuariosProdutores(true)
        );
    }

    public function IndexAllTaxas(Request $request){
        return view('admin.pages.Taxas.index');
    }
}
