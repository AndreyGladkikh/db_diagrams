FROM php:7.4-fpm

RUN apt-get update && apt-get install -y wget git unzip \
    && pecl install xdebug-3.0.1 \
    && docker-php-ext-enable xdebug

RUN wget https://getcomposer.org/installer -O - -q \
    | php -- --install-dir=/bin --filename=composer --quiet

COPY php.ini /usr/local/etc/php/php.ini

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && sync

RUN apt-get update && install-php-extensions mbstring