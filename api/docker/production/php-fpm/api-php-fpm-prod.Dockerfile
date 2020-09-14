FROM php:7.4-fpm-alpine

COPY . /app

COPY ./docker/production/php-fpm/conf.d /usr/local/etc/php/conf.d

WORKDIR app