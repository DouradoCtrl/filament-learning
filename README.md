# Instalação e Setup do Projeto

## 1. Pré-requisitos

- Docker e Docker Compose instalados
- PHP 8.1+ instalado na máquina (fora do Docker)
- Composer instalado

## 2. Subindo o Banco de Dados e Adminer

Execute o comando abaixo para subir o banco de dados PostgreSQL e o Adminer:

```bash
docker compose -f docker-compose.dev.yaml up -d --build
```

O banco ficará disponível para a aplicação e o Adminer estará em http://localhost:8080.

## 3. Instalando as dependências PHP

```bash
composer install
```

## 4. Configurando o ambiente

- Copie o arquivo `.env.example` para `.env` (se necessário)
- Ajuste as variáveis de ambiente conforme necessário (especialmente DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD)
- Gere a chave da aplicação:

```bash
php artisan key:generate
```

## 5. Rodando as migrations

Você pode rodar todas as migrations de uma vez:

```bash
php artisan migrate
```

Ou seguir a ordem sugerida abaixo para rodar migrations específicas:

```
# 1. Tabelas Base do Laravel
php artisan migrate --path=database/migrations/0001_01_01_000000_create_users_table.php && \
php artisan migrate --path=database/migrations/0001_01_01_000001_create_cache_table.php && \
php artisan migrate --path=database/migrations/0001_01_01_000002_create_jobs_table.php && \

# 2. Tabelas Base do Sistema (Indispensáveis para os Posts)
php artisan migrate --path=database/migrations/2026_03_19_175741_create_categories_table.php && \
php artisan migrate --path=database/migrations/2026_03_18_003136_create_tags_table.php && \

# 3. Conteúdo Principal (Depende de Categories)
php artisan migrate --path=database/migrations/2026_03_18_003135_create_posts_table.php && \

# 4. Relacionamentos e Interações (Dependem de Posts e Tags)
php artisan migrate --path=database/migrations/2026_03_18_003139_create_post_tag_table.php && \
php artisan migrate --path=database/migrations/2026_03_18_003137_create_comments_table.php && \
php artisan migrate --path=database/migrations/2026_03_18_003138_create_replies_table.php && \

# 5. Tabelas de Sistema e Utilitários
php artisan migrate --path=database/migrations/2026_03_25_182803_create_notifications_table.php && \
php artisan migrate --path=database/migrations/2026_03_25_182804_create_imports_table.php && \
php artisan migrate --path=database/migrations/2026_03_25_182805_create_exports_table.php && \
php artisan migrate --path=database/migrations/2026_03_25_182806_create_failed_import_rows_table.php
```

## 6. Rodando a aplicação

```bash
php artisan serve
```

O sistema estará disponível em http://localhost:8000 (ou porta definida em APP_URL).

---

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

In addition, [Laracasts](https://laracasts.com) contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

You can also watch bite-sized lessons with real-world projects on [Laravel Learn](https://laravel.com/learn), where you will be guided through building a Laravel application from scratch while learning PHP fundamentals.

## Agentic Development

Laravel's predictable structure and conventions make it ideal for AI coding agents like Claude Code, Cursor, and GitHub Copilot. Install [Laravel Boost](https://laravel.com/docs/ai) to supercharge your AI workflow:

```bash
composer require laravel/boost --dev

php artisan boost:install
```

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
