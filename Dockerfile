FROM php:7.3-alpine3.14

# install bash for debug
RUN apk add --no-cache bash

WORKDIR /usr/app

# TODO: copy only composer files and add code as a volume
# smth like
# COPY ./composer.json ./composer.lock ./
# however when introducing it, we've got troubles with autoload and resolving paths
COPY . ./

# install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php -r "if (hash_file('sha384', 'composer-setup.php') === '906a84df04cea2aa72f40b5f787e49f22d4c2f19492ac310e8cba5b96ac8b64115ac402c8cd292b8a03482574915d1a8') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');"

# move composer to access it globally
RUN mv composer.phar /usr/local/bin/composer

RUN composer install
RUN php artisan key:generate
RUN chmod -R 755 storage/

# TODO: install sqlite for tests
RUN apk add sqlite sqlite-dev

# install php extensions
RUN apk add openssl libxml2 libxml2-dev
RUN docker-php-ext-install bcmath \
    && docker-php-ext-install pdo \
    # provide docker-compose that wil run mysql server before app container starts
    # && docker-php-ext-install pdo_mysql \ 
    && docker-php-ext-install pdo_sqlite \
    && docker-php-ext-install ctype \
    && docker-php-ext-install fileinfo \
    && docker-php-ext-install json \
    && docker-php-ext-install mbstring \
    && docker-php-ext-install tokenizer \
    && docker-php-ext-install xml

# copy config for production to prevent from issues with short open tags
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

EXPOSE 8000

# TODO: install node and install js dependencies
# build them in separate stage and copy in the end
# similarly to https://github.com/roertbb/wsnake/blob/master/Dockerfile#L17
# RUN npm install
# RUN npm run build prod
# RUN rm -r ./node_modules

RUN php artisan migrate --seed
CMD php artisan serve --host=0.0.0.0 --port=8000