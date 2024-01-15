FROM webdevops/php-nginx:8.3-alpine
COPY . /app
WORKDIR /app
COPY --from=composer:2.4 /usr/bin/composer /usr/local/bin/composer
