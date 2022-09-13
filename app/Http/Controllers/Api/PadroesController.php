<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bases\IAPIController;
use Illuminate\Http\Request;

/**
 * @group Padrões
 *
 * Exemplos de retornos e filtros padrões de toda a API
 */
class PadroesController extends Controller implements IAPIController
{

        /**
         * Realiza o cadastro de entidades
         * 
         * A requisição irá depender de cada entidade, essa sempre será especificada
         * 
         * Todo retorno da api possui a estrutura abaixo (com exceção de erros 500 não mapeados. esses retornam a pilha de excessão do laravel)
         * "mensagem": resumo da atividade realizada
         * "erro": variável que representa se tudo o processo foi realizado com erros ou não
         * "mensagenserro": caso tenha acontecido um ou mais erros, estarão descritos neste retorno (array de strings)
         * "id": id (essa aplicação trabalha somente com UUID) da entidade que foi cadastrada.
         * "codigoretorno": código http do retorno da requisição. O retorno tb será o mesmo (não irá acontecer retorno 200 com codigoretorno 500 kkkkkk), esse campo foi criado a um caso de um dev que não conseguia obter o código de retorno
         * 
         * Obs.: Pode acontecer do campo "id" possuir vários ids, é o caso quando é necessário de mais informações do cadastro e não somente o id.
         * Espera-se que esses casos sejam mapeados no endpoint que ocorrer
         * 
         * Obs.: O retorno 401 será obtido sempre que o token da API não for encontrado ou já deslogado.
         * 
         * Obs.: O token não possui tempo de vida definido. Mas a quantidade de logins por usuário é limitada. Consulte o administrador para saber a quantidade de sessões permitidas (é parametrizavel)
         * 
         * O retorno padrão de cadastro é o 200.
         * @response 200
         * {
         *      "mensagem": "Entidade cadastrado com sucesso",
         *       "erro": false,
         *       "mensagenserro": [],
         *       "id": "867f0b91-1fd8-46ab-b906-10e65ffd5e6a",
         *       "codigoretorno": 200
         * }
         * 
         * @response 400 
         *  {
         *       "mensagem": "Um erro aconteceu",
         *       "erro": true,
         *       "mensagenserro": [
         *           "O campo 'nome' é requerido",
         *           "O campo 'idade' é requerido"
         *       ],
         *       "id": "00000000-0000-0000-0000-000000000000",
         *       "codigoretorno": 400
         *   }
         * 
         * @response 401 
         * {
         *      "mensagem": "Esse token não existe ou já foi deslogado",
         *       "erro": true,
         *      "mensagenserro": [],
         *       "id": "00000000-0000-0000-0000-000000000000",
         *       "codigoretorno": 401
         * }
         * 
         * @authenticated
         */
        function Cadastra(Request $request)
        {
                return ["End point somente de documentação, não funcional"];
        }

        /**
         * Obtem Listagem de Entidades cadastrados
         * 
         * Todo endpoint de listagem padrão possui os seguintes filtros
         *
         * @queryParam  per_page     integer     quantidade de elementos por página. Valor padrão: 20
         * @queryParam  with_trashed    integer     trazer elementos que estão na lixeira, valores 1 ou 0
         * @queryParam  trashed_only    integer     trazer somente elementos que estão na lixeira, valores 1 ou 0
         * @queryParam  id  uuid    Filtro por id
         * @queryParam  search  string      Busca por texto
         * 
         * 
         * O retorno padrão é o 200, o array "data" contém as entidades de fato. O restante do retorno é referente a paginação
         * 
         * @response 200 
         *   {
         *       "current_page": 1,
         *       "data": [
         *           {
         *               "id": "c1c3bd4a-3749-4fa5-b709-8e2cb59c3fee",
         *               "nome": "teste",
         *               "idade": 3
         *           }, {...}
         *       ],
         *       "first_page_url": "http://localhost/public/api/questionario?page=1",
         *       "from": 1,
         *       "last_page": 1,
         *       "last_page_url": "http://localhost/public/api/questionario?page=1",
         *       "links": [
         *           {
         *               "url": null,
         *               "label": "&laquo; Previous",
         *               "active": false
         *           },
         *           {
         *               "url": "http://localhost/public/api/questionario?page=1",
         *               "label": "1",
         *               "active": true
         *           },
         *           {
         *               "url": null,
         *               "label": "Next &raquo;",
         *               "active": false
         *           }
         *       ],
         *       "next_page_url": null,
         *       "path": "http://localhost/public/api/questionario",
         *       "per_page": 20,
         *       "prev_page_url": null,
         *       "to": 2,
         *       "total": 2
         *   }
         *
         * @authenticated
         */
        function Listagem(Request $request)
        {
                return ["End point somente de documentação, não funcional"];
        }

        /**
         * Obtem Visualizao detalhado
         * 
         * O retorno detalhado é a entidade e algum possível retorno associado. Ex. questionário e suas perguntas ou a pessoa e seu endereço
         * O retorno não é paginado (pois é view unica (por id))
         * 
         * @authenticated
         */
        public function Detalhado(Request $request, $id)
        {
                return ["End point somente de documentação, não funcional"];
        }

        /**
         * Realiza a edição de um cadastro
         *
         * geralmente a requisição é a mesma do cadastro
         * 
         * @authenticated
         */
        function Atualiza(Request $request, $id)
        {
                return ["End point somente de documentação, não funcional"];
        }

        /**
         * Move o registro para a lixeira
         * 
         * Não existe deleção real de registro
         * 
         * @authenticated
         */
        function Deleta(Request $request, $id)
        {
                return ["End point somente de documentação, não funcional"];
        }

        /**
         *  Remove um registro da lixeira
         *
         * @authenticated
         */
        function Restaura(Request $request, $id)
        {
                return ["End point somente de documentação, não funcional"];
        }

        public function ClonarRegistro (Request $request, $id){
                return ["End point somente de documentação, não funcional"];
        }
}
