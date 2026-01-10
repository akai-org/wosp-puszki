#!/bin/sh
set -e

# Run migrations
echo "Running migrations..."
php artisan migrate --force

# Clear caches
echo "Clearing caches..."
php artisan optimize:clear
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# php artisan optimize
echo "Optimizing..."
php artisan optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache


# echo "Detecting drivers..."
php vendor/bin/bdi detect drivers
