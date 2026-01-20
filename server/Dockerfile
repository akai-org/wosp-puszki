FROM webdevops/php-nginx:8.4-alpine

ENV WEB_DOCUMENT_ROOT=/app/public
ENV WEB_DOCUMENT_INDEX=index.php

USER root

RUN apk add postgresql-client chromium chromium-chromedriver

ENV CHROME_BIN=/usr/bin/chromium-browser \
    CHROME_DRIVER=/usr/bin/chromedriver

WORKDIR /app

COPY . .

# Install PHP dependencies
RUN composer install --optimize-autoloader

# Install NPM dependencies
RUN apk add --no-cache nodejs npm
RUN npm install

RUN npm run build

# Fix permissions
RUN chown -R application:application /app

# Copy entrypoint
COPY docker/entrypoint.sh /opt/docker/provision/entrypoint.d/99-entrypoint.sh
RUN chmod +x /opt/docker/provision/entrypoint.d/99-entrypoint.sh
