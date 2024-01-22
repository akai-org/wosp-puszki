#!/bin/bash

cp .env.example .env
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate:fresh --seed
docker compose exec app php artisan l5-swagger:generate
