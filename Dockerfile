FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    git \
     build-essential \
    zip

RUN pecl install -o -f xdebug \
    &&  rm -rf /tmp/pear \
    &&  docker-php-ext-enable xdebug

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY docker/php/ /usr/local/etc/php/conf.d

WORKDIR /var/www