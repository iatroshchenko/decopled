# Production php-cli Dockerfile. Building from api root folder -> index.php from here is "./public/index.php"

FROM php:7.4-cli-alpine

COPY ./ /app

COPY ./docker/production/php-cli/conf.d /usr/local/etc/php/conf.d

WORKDIR app