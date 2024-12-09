FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    git \
    zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www