include .env
export $(shell sed 's/=.*//' .env)

# DEVELOPMENT SECTION
up: docker-up
up-build: docker-up-build
down: docker-down
restart: down up
rebuild: down up-build
init: docker-down docker-pull docker-build docker-up api-composer-install

docker-up:
	docker-compose up -d

docker-down:
	docker-compose down --remove-orphans

docker-pull:
	docker-compose pull

docker-build:
	docker-compose build

docker-up-build:
	docker-compose up --build -d

cli-sh:
	docker exec -it bidding_api-php-cli_1 /bin/sh

api-composer-install:
	docker exec bidding_api-php-cli_1 composer install

# BUILD SECTION

build: build-gateway build-frontend build-api
build-gateway: build-gateway-nginx
build-frontend: build-frontend-nginx
build-api: build-api-nginx build-api-php-fpm build-api-php-cli

build-gateway-nginx:
	docker --log-level=debug build --pull --file=gateway/docker/production/nginx/gateway-nginx-prod.Dockerfile --tag=${REGISTRY}/bidding_gateway:${IMAGE_TAG} gateway/docker/production/nginx

build-frontend-nginx:
	docker --log-level=debug build --pull --file=frontend/docker/production/nginx/frontend-nginx-prod.Dockerfile --tag=${REGISTRY}/bidding_frontend-nginx:${IMAGE_TAG} frontend

build-api-nginx:
	docker --log-level=debug build --pull --file=api/docker/production/nginx/api-nginx-prod.Dockerfile --tag=${REGISTRY}/bidding_api-nginx:${IMAGE_TAG} api

build-api-php-fpm:
	docker --log-level=debug build --pull --file=api/docker/production/php-fpm/api-php-fpm-prod.Dockerfile --tag=${REGISTRY}/bidding_api-php-fpm:${IMAGE_TAG} api

build-api-php-cli:
	docker --log-level=debug build --pull --file=api/docker/production/php-fpm/api-php-cli-prod.Dockerfile --tag=${REGISTRY}/bidding_api-php-cli:${IMAGE_TAG} api

try-build:
	REGISTRY=localhost IMAGE_TAG=0 make build

# PUSH SECTION
push: push-gateway push-frontend push-api

push-gateway:
	docker push ${REGISTRY}/bidding_gateway:${IMAGE_TAG}

push-frontend: push-frontend-nginx
push-frontend-nginx:
	docker push ${REGISTRY}/bidding_frontend-nginx:${IMAGE_TAG}

push-api: push-api-nginx push-api-php-fpm push-api-php-cli

push-api-nginx:
	docker push ${REGISTRY}/bidding_api-nginx:${IMAGE_TAG}

push-api-php-fpm:
	docker push ${REGISTRY}/bidding_api-php-fpm:${IMAGE_TAG}

push-api-php-cli:
	docker push ${REGISTRY}/bidding_api-php-cli:${IMAGE_TAG}


prepare: build push

# DEPLOY SECTION
deploy:
	ssh ${USER}@${HOST} -p ${PORT} 'rm -rf bidding_${BUILD_NUMBER}'
	ssh ${USER}@${HOST} -p ${PORT} 'mkdir bidding_${BUILD_NUMBER}'
	scp -P ${PORT} docker-compose-production.yaml ${USER}@${HOST}:bidding_${BUILD_NUMBER}/docker-compose-production.yaml
	ssh ${USER}@${HOST} -p ${PORT} 'cd bidding_${BUILD_NUMBER} && echo "COMPOSE_PROJECT_NAME=bidding" >> .env'
	ssh ${USER}@${HOST} -p ${PORT} 'cd bidding_${BUILD_NUMBER} && echo "REGISTRY=${REGISTRY}" >> .env'
	ssh ${USER}@${HOST} -p ${PORT} 'cd bidding_${BUILD_NUMBER} && echo "IMAGE_TAG=${IMAGE_TAG}" >> .env'
	ssh ${USER}@${HOST} -p ${PORT} 'cd bidding_${BUILD_NUMBER} && docker-compose -f docker-compose-production.yaml pull'
	ssh ${USER}@${HOST} -p ${PORT} 'cd bidding_${BUILD_NUMBER} && docker-compose -f docker-compose-production.yaml up -d --build --remove-orphans'
	ssh ${USER}@${HOST} -p ${PORT} 'rm -f bidding'
	ssh ${USER}@${HOST} -p ${PORT} 'ln -sr bidding_${BUILD_NUMBER} bidding'

ssh:
	ssh root@${HOST}