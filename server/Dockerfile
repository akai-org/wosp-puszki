FROM webdevops/php-nginx:8.4-alpine

ENV WEB_DOCUMENT_ROOT=/app/public
ENV WEB_DOCUMENT_INDEX=index.php

USER root

RUN apk add postgresql18-client --repository=http://dl-cdn.alpinelinux.org/alpine/edge/main
RUN apk add chromium chromium-chromedriver

ENV CHROME_BIN=/usr/bin/chromium-browser \
    CHROME_DRIVER=/usr/bin/chromedriver

WORKDIR /app

COPY --chown=application:application . .

# Install PHP dependencies
RUN composer install --optimize-autoloader

# Install NPM dependencies
RUN apk add --no-cache nodejs npm
RUN npm install

RUN npm run build

# Copy entrypoint
COPY docker/entrypoint.sh /opt/docker/provision/entrypoint.d/99-entrypoint.sh
RUN chmod +x /opt/docker/provision/entrypoint.d/99-entrypoint.sh
