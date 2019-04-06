.PHONY: start-devenv stop-devenv clear-devenv build-devenv
DEFAULT_TARGET: start-devenv

VERSION_TAG ?= $(shell git rev-parse --short HEAD)

APP_NAME = anweb
DEVENV_DOCKER_COMPOSE = docker-compose -p $(APP_NAME) -f $(shell pwd)/docker-compose.yml
PROD_DOCKER_COMPOSE = docker-compose -p $(APP_NAME) -f $(shell pwd)/docker-compose-prod.yml

DOCKER_IMAGE = an_wp
VERSION_TAG = $(shell git rev-parse --short HEAD)
THEME_FOLDER = wp-content/themes/an-theme

start-devenv:
	$(DEVENV_DOCKER_COMPOSE) up -d

stop-devenv:
	$(DEVENV_DOCKER_COMPOSE) kill

build-css:
	cd $(THEME_FOLDER) \
	npx tailwind build styles/main.css -c tailwind.js -o styles/style.css

clear-devenv:
	$(DEVENV_DOCKER_COMPOSE) down -v --remove-orphans

build-devenv:
	$(DEVENV_DOCKER_COMPOSE) build

build-docker-image:
	docker build . --tag ${DOCKER_IMAGE}:${VERSION_TAG}
	docker tag ${DOCKER_IMAGE}:${VERSION_TAG} ${DOCKER_IMAGE}:latest

mysql-devenv:
	docker exec -it $(MYSQL_OPTIONS)

start-prod:
	make build-docker-image
	$(PROD_DOCKER_COMPOSE) up -d

stop-prod:
	$(PROD_DOCKER_COMPOSE) kill

clear-prod:
	$(PROD_DOCKER_COMPOSE) down -v --remove-orphans

build-prod:
	$(PROD_DOCKER_COMPOSE) build

mysql-prod:
	docker exec -it $(MYSQL_OPTIONS)


