<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
  <img src="https://img.shields.io/github/issues/Andreazza-dev/LivePremios">
  <img src="https://img.shields.io/github/license/Andreazza-dev/LivePremios">
  <img src="https://img.shields.io/github/forks/Andreazza-dev/LivePremios">
  <img src="https://img.shields.io/github/stars/Andreazza-dev/LivePremios">
</p>

### Requisitos (Laravel 6)
- PHP >= 7.2.0
- BCMath PHP Extension
- Ctype PHP Extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

#### Demo: 

Achou algum bug? ou quer sugerir uma melhoria? [Clique aqui e não se esconda](https://github.com/dshy1/PHP-Challenge-Laravel-2/issues/new)

**Gostou? Deixe sua estrelhinha aí em cima :)**

## Como instalar

```sh
$ git clone https://github.com/Andreazza-dev/LivePremios.git

$ cd LivePremios
$ composer install

$ cp .env.example .env

$ php artisan key:generate
```

Agora devemos crirar um banco de dados no nosso mysql (seja `phpMyAdmin` ou outros) e passar os dados do banco criado configurações para o nosso `.env` na pasta do nosso projeto.

```diff
- Caso o .env não esteja aparecendo!
- Verifique se seu sistema está ocultando os arquivos ocultos (Ctrl+H)

! Caso não resolveu! provavelmente você fez algum passo errado!
! Caso você fez tudo certo, reporte o problema nesse repositório.
```

#### Agora vamos iniciar nosso pojeto.

***Fazendo a integração das tabelas no nosso banco. (Necessário somente a primeira vez)***
```sh
$ php artisan migrate
```

***Agora vamos iniciar nosso servidor PHP (http://localhost:8000)***
```sh
$ php artisan serve
```

*Pronto! Basta acessar o localhost e usar :D*
