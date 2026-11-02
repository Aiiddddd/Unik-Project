# Runtime PHP-FPM untuk Laravel 13 + Filament 5.
# Kode project TIDAK dimasukkan ke image; folder /var/www/unik di host di-mount ke container.
FROM php:8.4-fpm

RUN apt-get update \
 && apt-get install -y --no-install-recommends git unzip \
 && rm -rf /var/lib/apt/lists/*

COPY --from=ghcr.io/mlocati/php-extension-installer:latest /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions intl gd zip bcmath exif opcache

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer
ENV COMPOSER_HOME=/tmp/composer

WORKDIR /var/www/unik
