#!/bin/bash

docker-compose exec app composer install
cp .env.example .env
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate --seed
docker-compose exec web chown -R www-data:www-data /app/storage/
