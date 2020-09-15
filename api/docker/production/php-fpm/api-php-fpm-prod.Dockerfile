# Production php-fpm Dockerfile. Building from api root folder -> index.php from here is "./public/index.php"

### First stage - temporary - get optimized vendors folder ###
FROM php:7.4-cli-alpine AS temp

RUN apk add unzip

ENV COMPOSER_ALLOW_SUPERUSER 1

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/bin --filename=composer --quiet \
  && composer global require hirak/prestissimo --no-plugins --no-scripts \
  && rm -rf /root/.composer/cache

WORKDIR /app

## Prepare vendor folder
COPY ./composer.json ./composer.lock ./

RUN composer install --no-dev --prefer-dist --no-progress --no-suggest --optimize-autoloader \
  && rm -rf /root/.composer/cache

### Final stage ###
FROM php:7.4-fpm-alpine

RUN docker-php-ext-install opcache

RUN mv $PHP_INI_DIR/php.ini-production $PHP_INI_DIR/php.ini

COPY ./docker/production/php-fpm/conf.d /usr/local/etc/php/conf.d

WORKDIR /app

## Copy vendor folder
COPY --from=temp /app ./

## Copy rest of the files
COPY ./ ./