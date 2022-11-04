#!/bin/bash

docker-compose exec app composer install
cp .env.example .env
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate
docker-compose exec app chmod -R 755 storage/
