# Production php-cli Dockerfile. Building from api root folder -> index.php from here is "./public/index.php"

FROM php:7.4-cli-alpine

COPY ./ /app

COPY ./docker/production/php-cli/conf.d /usr/local/etc/php/conf.d

ENV COMPOSER_ALLOW_SUPERUSER 1

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/bin --filename=composer --quiet \
  && composer global require hirak/prestissimo --no-plugins --no-scripts \
  && rm -rf /root/.composer/cache

WORKDIR app