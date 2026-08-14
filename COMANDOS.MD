# COMANDOS.md

## Projeto do zero

```bash
composer create-project laravel/laravel nome-do-projeto
php artisan key:generate
```

## Migrations

```bash
php artisan migrate
```

## Criar uma entidade nova 

```bash
php artisan make:model Nome                   # Cria só o model
php artisan make:model Nome -m                # Cria model + migration
php artisan make:migration create_nomes_table # Cria só a migration
```

```bash
php artisan make:controller NomeController --api
```
O `--api` gera o controller já com os métodos index/store/show/update/destroy (sem create/edit, que são pra views).

## Rodar o servidor local

```bash
php artisan serve
```

## Ver rotas registradas

```bash
php artisan route:list
```

## Testar a API

Rodar o **Thunder Client** no VSCode.