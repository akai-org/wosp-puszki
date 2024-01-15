FROM webdevops/php-nginx:8.3-alpine
COPY . /app
WORKDIR /app
COPY --from=composer:2.4 /usr/bin/composer /usr/local/bin/composer
RUN apt update && apt-get install -y git libzip-dev zip \
  && docker-php-ext-install zip pdo pdo_mysql
