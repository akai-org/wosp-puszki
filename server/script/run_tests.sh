#!/bin/bash

docker-compose up -d
docker-compose exec app php artisan migrate --seed
docker-compose exec app php artisan test
