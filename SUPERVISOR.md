# SUPERVISOR

Fonte: https://learn2torials.com/a/how-to-setup-laravel-supervisor

0. `apt-get install supervisor`: instala o supervisor
1. `cd /etc/supervisor/conf.d`: vai para pasta instalação
2. `vim laravel-worker.conf`: trocar 'laravel-worker' pelo nome do program que será criado
3. Preencher arquivo com o conteúdo:

```CONF

[program:laravel-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/app.com/artisan queue:work --daemon
autostart=true
autorestart=true
user=forge
numprocs=8
redirect_stderr=true
stdout_logfile=/var/www/app.com/worker.log​

```
Alterando os caminhos pelos caminhos corretos. Alterar o usuário para o usuário com nível de acesso suficiente.

## Adição e reinicialização

4. `sudo supervisorctl reread`: ler a nova configuração criada
5. `sudo supervisorctl update`: Ativa a nova configuração
6. `sudo supervisorctl start laravel-worker:*`: Inicia o comando da fila
