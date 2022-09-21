<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
class BuscasController extends Controller{

    private function ObtemTermoBusca(Request $request){
        $filtros = $request->all();
        $termo = "";
        if(array_key_exists('search', $filtros) && strcasecmp('', $filtros['search']) != 0){
            $termo = '%'. $filtros['search'] .'%';
        }
        return $termo;
    }

    private function ContruiFiltroIlike($consulta, $busca = '', $filtros=[]){
        if(strcasecmp('', $busca) == 0 || count($filtros) == 0) return $consulta;
        $consulta = $consulta->where(function($query) use ($busca, $filtros){
            $n = count($filtros);
            for($i = 0; $i < $n; $i++){
                ($i== 0) ? 
                    $query->where($filtros[$i], 'ilike', $busca)
                    :
                    $query->orWhere($filtros[$i], 'ilike', $busca);
            }
        });
        return $consulta;
    }

    private function OrdernarRetorno($consulta, Array $ordenar = []){
        foreach($ordenar as $campo){
            $consulta = $consulta->orderBy($campo);
        }
        return $consulta;
    }

    private function ObtemItensExibir($consulta, Array $camposRetorno , $qtd = 20){
        return $consulta->limit($qtd)->get($camposRetorno);
    }

    public function Usuarios(Request $request){
        $consulta = $this->ContruiFiltroIlike(
            User::query(), 
            $this->ObtemTermoBusca($request), 
            ['name', 'email', 'username']);

        return $this->ObtemItensExibir(
            $this->OrdernarRetorno(
                $consulta, ['name']
            ), ['id', 'name']);
    }
}