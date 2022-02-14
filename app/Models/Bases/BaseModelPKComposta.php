<?php 
namespace App\Models\Bases;

use App\Utils\Buscas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class BaseModelPKComposta extends Model{
    use SoftDeletes;
    public $incrementing = false;
    /**
     * Set the keys for a save update query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function setKeysForSaveQuery($query)
    {
        $keys = $this->getKeyName();
        if(!is_array($keys)){
            return parent::setKeysForSaveQuery($query);
        }

        foreach($keys as $keyName){
            $query->where($keyName, '=', $this->getKeyForSaveQuery($keyName));
        }

        return $query;
    }

    /**
     * Get the primary key value for a save query.
     *
     * @param mixed $keyName
     * @return mixed
     */
    protected function getKeyForSaveQuery($keyName = null)
    {
        if(is_null($keyName)){
            $keyName = $this->getKeyName();
        }

        if (isset($this->original[$keyName])) {
            return $this->original[$keyName];
        }

        return $this->getAttribute($keyName);
    }

    protected static function ProcessaAtualizacaoCadastro(
        String $campoBase, String $campoRelacao,
        $instanciaBase, $idsFuturasRelacoes, $relacoesPossiveis, $instanciasAtuais
    ){
        $erros = Array();
        if(isset($idsFuturasRelacoes) && is_array($idsFuturasRelacoes)){
            $idsInserts = Array();
            foreach($idsFuturasRelacoes as $idPermissao){
                $indiceP = Buscas::Binaria($relacoesPossiveis, $idPermissao);
                if($indiceP < 0){
                    array_push($erros, "A relação '$campoRelacao': [$idPermissao] não existe ou está inativa");
                    break 1;
                }
                $update = false;
                foreach($instanciasAtuais as $permissaoBanco){
                    if(strcasecmp($idPermissao, $permissaoBanco->{$campoRelacao}) === 0){
                        if($permissaoBanco->trashed()){
                            $permissaoBanco->restore();
                        }
                        $update = true;
                        array_push($idsInserts, $permissaoBanco->{$campoRelacao});
                        break;
                    }
                }
                if(!$update){
                    $cadastro = self::create(Array(
                        $campoBase => $instanciaBase->id,
                        $campoRelacao => $idPermissao
                    ));
                    if($cadastro){
                        array_push($idsInserts, $idPermissao);
                    }else{
                        array_push($erros, "Um erro ocorreu ao criar o registro. Retrate cenário ao suporte");
                        break 1;
                    }
                }
            }
            /* todos os inserts foram realizados sem erros */
            if(count($idsFuturasRelacoes) === count($idsInserts)){
                self::query()
                ->where($campoBase,'=', $instanciaBase->id)
                ->whereNotIn($campoRelacao, $idsInserts)
                ->delete();
            }
        }else{
            array_push($erros, "Lista de futuras relações '$campoRelacao' não foram informadas");
        }
        return $erros;
    }
    
    public function GeraArrayInsert($request){
        if($request instanceof Request)
            return $request->all();
        return $request;
    }
}