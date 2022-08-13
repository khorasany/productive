FROM php:8.0.2-fpm

WORKDIR /var/www/html

RUN docker-php-ext-install pdo pdo_mysql