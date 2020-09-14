FROM nginx:1.17-alpine

COPY . /app

COPY ./docker/production/nginx/conf.d /etc/nginx/conf.d

WORKDIR /app