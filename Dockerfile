FROM php:8.2-fpm-alpine AS symfony_php_base
FROM composer/composer:2-bin AS composer_upstream


#Base project image
FROM symfony_php_base AS symfony_php

# Set working directory
WORKDIR /app
# add install-php-extensions script 
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions gd xdebug
# Install dependencies
RUN apk add --no-cache \
    acl \
    file \
    gettext \
    git \
    ;

RUN set -eux; \
    install-php-extensions \
    apcu \
    intl \
    opcache \
    zip \
    pdo_pgsql \
    ;

COPY ./docker/php/docker-entrypoint.sh /usr/local/bin/docker-entrypoint
RUN chmod +x /usr/local/bin/docker-entrypoint

ENTRYPOINT ["docker-entrypoint"]
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV PATH="${PATH}:/root/.composer/vendor/bin"
COPY --from=composer_upstream --link /composer /usr/bin/composer
# Install project dependencies

# Set up development environment
FROM symfony_php AS symfony_php_dev
ENV APP_ENV=dev XDEBUG_MODE=off
VOLUME /app/var/
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

RUN set -eux; \
    install-php-extensions \
    xdebug \
    ; 
# Set up production environment
ENV APP_ENV=prod
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
COPY --link composer.* symfony.* ./
RUN set -eux; \
    composer install --no-cache --prefer-dist --no-dev --no-autoloader --no-scripts --no-progress

COPY --link . ./
RUN set -eux; \
    mkdir -p var/cache var/log; \
    composer dump-autoload --classmap-authoritative --no-dev; \
    composer dump-env prod; \
    composer run-script --no-dev post-install-cmd; \
    chmod +x bin/console; sync;
