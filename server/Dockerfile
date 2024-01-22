FROM webdevops/php-nginx:8.3-alpine
COPY . /app
WORKDIR /app
RUN chmod -R 777 /app/storage
RUN composer install --no-dev -n
