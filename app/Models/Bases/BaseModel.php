<?php
namespace App\Models\Bases;

use App\Models\MultimidiaArquivos;
use App\Utils\ArquivosStorage;
use App\Utils\BaseRetornoApi;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class BaseModel extends Model{
    use SoftDeletes;
    
    public static $guidempty = "00000000-0000-0000-0000-000000000000";

    protected static function boot(){
        parent::boot();
        static::creating(function ($post) {
            $post->{$post->getKeyName()} = (string) Str::uuid();
        });
    }

    public function getIncrementing(){
        return false;
    }
    
    public function getKeyType(){
        return 'string';
    }

    public function GetValidadorCadastro($request){
        return [];
    }
    public function GetValidadorAtualizacao($request, $id){
        return [];
    }

    public static  function AplicaFiltroConsulta(Builder $consulta, $filtros, $chave, $nomeChaveConsulta = null, $operador = '=', $where = 'where'){
        if(is_null($nomeChaveConsulta)){
            $nomeChaveConsulta = $chave;
        }
        if(array_key_exists($chave, $filtros)){
            $consulta = $consulta->{$where}($nomeChaveConsulta, $operador, $filtros[$chave]);
        }
        return $consulta;
    }

    public function ConstruiFiltroListagem(Builder $consulta, Request $request) : Builder{
        return $consulta;
    }

    public function ColunasListagem() : Array{
        return $this->fillable;
    }

    /**
     * Gera array para ordenação a partir da requisicao orderby
     */
    public function ColunasOrdenacao(Request $request) : Array{
        $arrayorder = $request->get('orderby', []);
        if(!is_array($arrayorder)) return [];
        $retorno = Array();
        foreach($arrayorder as $ordena){
            if(array_key_exists('campo', $ordena)){
                $add = Array(
                    'campo' => $ordena['campo'],
                    'ordem' => 'ASC'
                );
                if(array_key_exists('ordem', $ordena)){
                    $add['ordem'] = $ordena['ordem'];
                }
                array_push($retorno, $add);
            }
        }
        return $retorno;
    }

    public function ColunasEdicao(){
        return $this->fillable;
    }

    public static function GetColunasListagem(){
        $ins = new static;
        return $ins->fillable;
    }

    public function GetTableName(){
        return $this->table;
    }
    public function GetLikeFields(){
        return [];
    }

    public function GetMenssagensValidacao(){
        return Array(
            'required' => "O campo ':attribute' é requerido",
            'unique' => "O campo ':attribute' já contem um valor idêntico",
            'exists' => "O ':attribute' não existe na tabela alvo",
            'current_password' => "Senha informada não corresponde a atual",
            'date' => "O campo ':attribute' não é uma data válida",
            'after' => "A data informada em ':attribute' deve ser posterior a ':date'",
            'before' => "A data informada em ':attribute' deve ser anterior a ':date'",
            'boolean' => "O campo ':attribute' deve ser um booleano",
            'url' => "O campo ':attribute' não corresponde a uma URL",
            'email' => "O campo ':attribute' não é um email válido",
            'max' => [
                "numeric" => "O campo ':attribute' deve ter o valor máximo de :max",
                "string" => "O campo ':attribute' deve ter o comprimento máximo de :max"
            ],
            'min' => [
                "numeric" => "O campo ':attribute' deve ter o valor mínimo de :min",
                "string" => "O campo ':attribute' deve ter o comprimento mínimo de :min"
            ],
        );
    }

    public function GeraArrayInsert($request){
        if($request instanceof Request)
            return $request->all();
        return $request;
    }
    
    public function UpdateRegistro($request, Model &$item){
        $colunasEdicao = $this->ColunasEdicao();
        foreach($colunasEdicao as $campo){
            if(strcasecmp('id', $campo) == 0)
                continue;
            if(array_key_exists($campo, $request)){
                $item->{$campo} = $request[$campo];
            }
        }
    }

    public function NormalizaDados(&$dados, $atualizacao = false){
    }

    public static function NormalizaFiltros(Request &$filtros){
    }

    public static function CriaLog(&$dadosRequisicao, $idRegistro = null, $atualizacao = false){
    }

    /**
     * Retorna um UUID se cadastro ocorreu com suceso, ou um Validator caso tenha falhado na validação
     */
    public static function CadastraElementoArray($dados){
        $instancia = new static;
        $instancia->NormalizaDados($dados);
        $valida = Validator::make($dados, $instancia->GetValidadorCadastro($dados), $instancia->GetMenssagensValidacao());
        if ($valida->fails()) {
            return $valida;
        }else{
            return self::create(
                $dados
            )->id;
        }
    }

    /**
     * Verifica se o $value é um Validator
     */
    public static function CheckIfIsValidator($value){
        return ($value instanceof ValidationValidator);
    }

    public static function VerificaRetornoSucesso($retorno){
        if(static::CheckIfIsValidator($retorno)){
            return false;
        }
        if($retorno instanceof JsonResponse && $retorno->original[BaseRetornoApi::$CampoErro]){
            return false;
        }
        return true;
    }

    public static function CadastraElemento(Request $request){
        try{
            $dados = $request->all();
            $id = static::CadastraElementoArray($dados);
            if(static::CheckIfIsValidator($id)){
                return BaseRetornoApi::GetRetornoErro($id->errors()->all(), "O registro não foi criado");
            }else{
                if($id instanceof JsonResponse)
                    return $id;
                if($id){
                    static::CriaLog($dados, $id);
                    return BaseRetornoApi::GetRetornoSucessoId("Registro Criado com sucesso", $id);
                }else{
                    return BaseRetornoApi::GetRetornoErro(Array());
                }
            }
        }
        catch(Exception $erro){
            return BaseRetornoApi::GetRetornoErroException($erro);
        }
    }

    public static function GeraErro(
        $erros, 
        $rollback = true, 
        $mesagem ="Um erro aconteceu", 
        $codigo = 400, 
        $apagarImagens = false,
        $pathsImagens = []){

        if($rollback)
            DB::rollBack();
        if(parent::CheckIfIsValidator($erros)){
            $erros = $erros->errors()->all();
        }elseif($erros instanceof JsonResponse){
            $erros = $erros->original[BaseRetornoApi::$MensagensErro];
        }elseif($erros instanceof Exception){
            Log::error($erros);
            $erros = [$erros->getMessage()];
        }else{
            if(!is_array($erros))
                $erros = [$erros];
        }
        if($apagarImagens){
            foreach($pathsImagens as $path){
                ArquivosStorage::DeletaArquivo($path);
            }
        }
        return BaseRetornoApi::GetRetornoErro($erros, $mesagem, $codigo);
    }

    public static function ObtenhaDataTimeBanco($data, $format = 'd/m/Y H:i:s'){
        if(is_null($format)){
            $data = new Carbon($data);
        }else{
            $data = Carbon::createFromFormat($format, $data);
        }
        $data->timezone('America/Sao_Paulo');
        $data = $data->toDateTimeString();
        return $data;
    }

    public static function AtualizaElementoArray($dados, &$instanciaBanco){
        $instancia = new static;
        $instancia->NormalizaDados($dados, true);
        $valida = Validator::make($dados, $instancia->GetValidadorAtualizacao($dados, $instanciaBanco->id), $instancia->GetMenssagensValidacao());
        if($valida->fails()){
            return $valida;
        }else{
            $instancia->UpdateRegistro($dados, $instanciaBanco);
            $instanciaBanco->save();
            return $instanciaBanco->id;
        }
    }

    public static function AtualizaElemento(Request $request, $id){
        try{
            $item = static::query()->where('id', '=', $id)->first();
            if($item){
                $dados = $request->all();
                $atualiza = static::AtualizaElementoArray($dados, $item);
                if( static::CheckIfIsValidator($atualiza) ){
                    return BaseRetornoApi::GetRetornoErro($atualiza->errors()->all(), "O registro não foi atualizado");
                }else{
                    if($atualiza instanceof JsonResponse)
                        return $atualiza;
                    else{
                        static::CriaLog($dados, $id, true);
                        return BaseRetornoApi::GetRetornoSucessoId("Registro atualizado com sucesso", $id);
                    }
                }
            }else{
                return BaseRetornoApi::GetRetornoNaoEncontrado();
            }
        }
        catch(Exception $erro){
            return BaseRetornoApi::GetRetornoErroException($erro);
        }
    }

    #region ClonarRegistro
    public static function ObtemColunasClonar(){
        $ins = new static;
        return $ins->fillable;
    }

    public static function ObtemPKClonar($class){
        return Array();
    }

    public static function ObtemModelsPKClonar(){
        return Array();
    }

    public static function ClonaRegistro(Request $request, $id){
        try{
            $item = static::query()->where('id', '=', $id)->first();
            if(!$item){
                return BaseRetornoApi::GetRetorno404("O elemento informado não existe ou já foi excluído");
            }
            $idNovoRegistro = static::ClonaRegistroArray($item, $request->all());
            return BaseRetornoApi::GetRetornoSucessoId("Registro clonado com sucesso", $idNovoRegistro);
        }catch(Exception $erro){
            return BaseRetornoApi::GetRetornoErroException($erro);
        }
    }

    /** 
     * $original: deve ser a referencia para a instancia do banco que deve ser clonado.
     * $novosValores: array com os valores que devem ser clonados com valores diferentes dos original
    */
    public static function ClonaRegistroArray(&$original, $novosValores = []){
        $originalArray = $original->toArray();
        $colunasClonar = static::ObtemColunasClonar();
        $insert = Array();
        foreach($colunasClonar as $cc){
            if(array_key_exists($cc, $originalArray) && (strcasecmp('id', $cc) != 0)){
                $insert[$cc] = $originalArray[$cc];
                if(array_key_exists($cc, $novosValores)){
                    $insert[$cc] = $novosValores[$cc];
                }
            }
        }
        $dolly = static::create($insert);
        $modesRelacionados = static::ObtemModelsPKClonar();
        foreach($modesRelacionados as $model){
            $pk = $model::ObtemPKClonar(static::class);
            if(is_null($pk)){
                continue;
            }
            $arrayNovosValores = Array(
                $pk => $dolly->id
            );
            $instanciasRelacionadas = $model::query()
            ->where($pk, '=', $original->id)
            ->get();
            foreach($instanciasRelacionadas as $insRela){
                $model::ClonaRegistroArray($insRela, $arrayNovosValores);
            }
        }
        return $dolly->id;
    }
    #endregion ClonarRegistro

    protected function MontarConsultaBuscaTexto(&$consulta, $termo){
        $buscaTexto = "%".strtoupper($termo)."%";
        $termos = $this->GetLikeFields();

        $consulta = $consulta->where(function($q) use ($termos, $buscaTexto) {
            foreach($termos as $key=>$termo){
                if($key == 0){
                    $q->where($termo, 'ilike', $buscaTexto);
                }else{
                    $q->orWhere($termo, 'ilike', $buscaTexto);
                }
            }
        });
        return $consulta;
    }

    public static function ListagemElemento(Request $request, $nopaginate = NULL){
        $instancia = new static;
        $consulta = self::query();
        $incluiExcluidos = false;
        if( intval($request->get('with_trashed', 0)) == 1){
            $consulta = self::withTrashed();
            $incluiExcluidos = true;
        }
        if( intval($request->get('trashed_only', 0)) == 1){
            $consulta = self::onlyTrashed();
            $incluiExcluidos = true;
        }
        if( !is_null($request->get('id', null)) ){
            $consulta = $consulta->where($instancia->GetTableName().'.id','=',$_GET['id']);
        }
        if( !is_null($request->get('search', null)) ){
            $instancia->MontarConsultaBuscaTexto($consulta, $_GET['search']);
        }

        $camposRetorno = $instancia->ColunasListagem();
        $camposOrdenacao = $instancia->ColunasOrdenacao($request);
        static::NormalizaFiltros($request);

        if($incluiExcluidos){
            array_push($camposRetorno,$instancia->GetTableName().'.deleted_at');
        }
        
        $consulta = $instancia->ConstruiFiltroListagem($consulta, $request);

        foreach($camposOrdenacao as $ordena){
            $consulta = $consulta->orderBy($ordena['campo'], $ordena['ordem']);
        }

        if(!$nopaginate) {
            return $consulta->paginate(intval($request->get('per_page', 20)), $camposRetorno);
        } else {
            return $consulta->get($camposRetorno);
        }
    }

    public static function Detalhado(Request $request, $id){
        return static::ObtemElementoUnico($id);
    }

    public static function ObtemElementoUnico($id){
        return static::withTrashed()->where('id', '=', $id)->first();
    }

    public static function DeleteElemento(Request $request, $id){
        if(static::DeletaElemento($id)){
            return BaseRetornoApi::GetRetornoSucessoId("Registro excluído com sucesso", $id);
        }else{
            return BaseRetornoApi::GetRetornoNaoEncontrado();
        }
    }

    public static function DeletaElemento($id){
        $item = self::query()->where('id', '=', $id)->first();
        if($item){
            $item->delete();
            return true;
        }else{
            return false;
        }
    }

    public static function RestoreElemento(Request $request, $id){
        $elemento = self::withTrashed()->where('id', '=', $id)->first();
        if($elemento){
            $elemento->restore();
            return BaseRetornoApi::GetRetornoSucessoId("Registro restaurado com sucesso", $id);
        }else{
            return BaseRetornoApi::GetRetornoNaoEncontrado();
        }
    }

    public static function SalvaImagem($base64Imagem, $tipoImagem, $usuario_id = null, $caminhorelativo = false, $storageFolder = 'imagens'){
        $nomeArquivo = false;
        if(isset($base64Imagem)){
            if(isset($tipoImagem)){
                if($caminhorelativo){
                    $nomeArquivo = $caminhorelativo;
                }else{
                    $nomeArquivo = ArquivosStorage::GetRelativePath($storageFolder, $tipoImagem);
                }
                ArquivosStorage::Base64ParaImagem($base64Imagem, ArquivosStorage::GetPathImagem($nomeArquivo, $storageFolder));
            }else{
                throw new Exception("É necessário informar o tipo da imagem.");
            }
        }
        MultimidiaArquivos::create(Array(
            'usuario_id' => $usuario_id, 
            'path_relativo' => $nomeArquivo,
            'model' => static::class
        ));
        return $nomeArquivo;
    }

    public static $BasePath = 'resources'.DIRECTORY_SEPARATOR.'storage';

    public static function SalvaArquivo($files, $storageFolder = 'arquivos'){
        $nomesArquivo = [];
        if(isset($files)){
            if (!file_exists(public_path($storageFolder))) {
                mkdir(public_path(self::$BasePath), 0755, true);
            }
            $targetDir = public_path(self::$BasePath. DIRECTORY_SEPARATOR . $storageFolder);
            if (isset($_FILES[$files])) {
                $total = count($_FILES[$files]['name']);
                for( $i=0 ; $i < $total ; $i++ ) {
                    $ext = pathinfo($_FILES[$files]['name'][$i], PATHINFO_EXTENSION); //Pegando extensão do arquivo
                    $new_name = md5(date('d-m-Y H:i:s:u')).'.'.$ext; //Definindo um novo nome para o arquivo

                    if(move_uploaded_file($_FILES[$files]['tmp_name'][$i], $targetDir.DIRECTORY_SEPARATOR.$new_name)) {
                        $nomesArquivo[] = $new_name;
                    }
                }
            } else {
                throw new Exception("É necessário informar o tipo da imagem.");
            }
        }
        return $nomesArquivo;
    }

    public static function ObtemSqlQueryBuilder($consulta){
        $query = str_replace(array('?'), array('\'%s\''), $consulta->toSql());
        $query = vsprintf($query, $consulta->getBindings());
        return $query;
    }
}
