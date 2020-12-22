FROM php:7.4-fpm

RUN apt-get update && apt-get install -y wget git unzip \
    && pecl install xdebug-3.0.1 \
    && docker-php-ext-enable xdebug

RUN wget https://getcomposer.org/installer -O - -q \
    | php -- --install-dir=/bin --filename=composer --quiet

COPY php.ini /usr/local/etc/php/php.ini