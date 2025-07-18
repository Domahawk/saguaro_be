# Stack
- PHP 8.1
- Laravel 8.75
- MySQL
- Docker Compose

# How to run
You need to have Docker Compose installed, since this project is using Laravel Sail.

Clone this repo.

Run docker compose:
```bash
docker compose up -d
```
Once the images are up and running, you can install dependencies like this:

- Enter the laravel.test container as non-root user
```bash
docker compose exec -it -u 1000 laravel.test bash
```

- Install dependencies with composer:
```bash
composer install
```

- Run migrations
```bash
php artisan migrate
```

- Populate database with initial data
```bash
php artisan db:seed
```

You can now exit the container and start consuming the API.

If you are missing `.env` file, `.env.example` is provided in the project, which contains all dev ENV variables to run the app.
You can just copy/paste `.env.example` and rename it to `.env`
