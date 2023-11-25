FROM php:8-fpm
COPY . /app
WORKDIR /app
COPY --from=composer:2.4 /usr/bin/composer /usr/local/bin/composer
RUN apt update && apt-get install -y git libzip-dev zip \
  && docker-php-ext-install zip pdo pdo_mysql bcmath
