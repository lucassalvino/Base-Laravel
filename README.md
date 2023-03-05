# Base laravel

# Configuração da conexão PGSQL

0. Instalar postgresql versão 10 ou superior
1. Instalar e habilitar a extensão pgsql no php (apt-get install php-pgsql) - possível ajuda em: https://www.enterprisedb.com/postgres-tutorials/how-use-postgresql-laravel
2. Configurar o arquivo .env como o exemplo:

# Configurações gerais necessárias
1. a2enmod rewrite :: necessário para funcionamento do apache + laravel 
2. memory_limit = -1 :: necessário para gerencia de processos no servidor de catracas somente (arquivo php.ini)

```
DB_CONNECTION=pgsql
DB_HOST=localhost
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=postgres
DB_PASSWORD=postgres
```

obs.: crie o banco antes de seguir os passos

# ENV adicionais

* ```HASH_SENHA```: algoritmo de hash a ser usado no hash da senha de usuários. Definir antes da criação da base. Valor padrão: *** sha512 ***. O campo string do banco salva no máximo 128 digitos
* ```HASH_TOKEN_API```: algoritmo de hash a ser usado no hash do token da api. Valor padrão: *** sha512 ***. O campo string do banco salva no máximo 128 digitos
* ```SESSAO_ATIVA_USUARIO```: Quantidade de sessões ativas por usuário, por padrão duas sessões (em tese uma para mobile e outra para descktop - web).
* ```COMPLEMENTO_PATCH_IMAGEM```: Complemento de url para configuração de endereço auxiliar do host do servidor de catracas. É usuado para complementar o endereço para multiplos sites hospedados no mesmo servidor (apache), sendo a configuração o caminho relativo. Ex.: `raiz/public`. Caso não tenha necessidade preencher com string vazia
* ```TIPO_CADASTRO_IMAGEM```: Configuração para cadastro de imagem nos terminais facias
* * `url`: o cadastro será feito via endereço http do servidor, necessário que o servidor esteja aberto para a rede interna
* * `base64`: o cadastro será feito com base64, não sendo necessário a hospedagem da imagem, somente do bas64 da mesma


# Execução

Passos:

0. criar o arquivo .env e configurar a conexão pgsql.
1. `composer install` || `composer install --ignore-platform-reqs`
2. `php artisan key:generate`
3. `composer dump-autoload`
4. `php artisan migrate`
5. `php artisan db:seed`
7. Acessar pasta Public (se for com servidor http) ou `php artisan serve`

# RESETAR BANCO DE DADOS

*** pq vc vai fazer isso? isso é realmente necessário? ***

0. faça o backup da base (pfv)
1. `php artisan migrate:reset`
2. `php artisan migrate`
3. `php artisan db:seed`
5. feito


## UTIL para GIT
* `git config core.fileMode false`: ignora alterações de permissões realizadas com o `chmod`

## Serviços Executar (background)

* Fila: `php artisan queue:work` : Executa a lista de eventos, necessário para realizar o envio de notificações ou tarefas de segundo plano
* Para executar a fila com modo recover (caso caia ela retorna): `php artisan queue:work --tries=1`
Alterar `QUEUE_CONNECTION` no `.env` para `database`. Ex.: `QUEUE_CONNECTION=database`
* Serviços: `php artisan schedule:work` : Executa Agendamentos 

Obs.: Em produção utilizar o supervisor. Ler mais em SUPERVISOR.md


# Comandos Desenvolvimento

* `php artisan scribe:generate`: Atualiza documentação API
* `php artisan make:migration NOME_MIGRATION`: Cria um migration


# Configuração de Email

## .env

* ```EMAIL_TIPO_ENVIO```: 
* * `SMTP`: Será utilizado o envio padrão do laravel, sendo necessário realizar a configuração de MAIL_* no .env
* * `MAUTIC`: Será utilizado o envio pelo mauitc, sendo necessário realizar a configuração da URL do mautic
> > Ex.: EMAIL_TIPO_ENVIO=MAUTIC
* `EMAIL_MAUTIC_URL`: URL do mauitc. Recomendavel utilizar HTTPS
> > Ex.: EMAIL_MAUTIC_URL=https://mautic.com.br


# STORAGE
## .env

* ```STORAGE```
* * `S3`: Será utilzilido o armazenamento no S3 da AWS. Quando selecionado, é necessário configurar as credenciais da AWS (AWS_ACCESS_KEY_ID, AWS_SECRET_ACCESS_KEY, AWS_DEFAULT_REGION, AWS_BUCKET, AWS_USE_PATH_STYLE_ENDPOINT).
* * `local`: Será armazenado localmente, dentro de public/storage