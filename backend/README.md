# API Restful desenvolvida com Laravel 8

### Alterar configurações
Criar e/ou alterar o arquivo .env, e alterar os valores para conexão com o banco de dados e os dados SMTP

### Instalar dependência
`composer install`

### Rodar migrations e seed
`php artisan migrate --seed`

### Instalar Passport
`php artisan passport:install`

### Executar o servidor
`php artisan serve`

### Executar os testes
`php artisan test`

### Executar os lints
`php artisan insights --config-path="config/insights.php"`

`phpcs ./app"`

### Usuários
Nome     | E-mail             | Senha    | Perfil
-------- | ------------------ | -------- | ------
Admin    | admin@email.com    | admin    | admin
Vinicius | vinicius@email.com | vinicius | normal
