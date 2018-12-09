.PHONY: start-devenv stop-devenv clear-devenv build-devenv
DEFAULT_TARGET: start-devenv

VERSION_TAG ?= $(shell git rev-parse --short HEAD)

APP_NAME = anweb
DEVENV_DOCKER_COMPOSE = docker-compose -p $(APP_NAME) -f $(shell pwd)/docker-compose.yml
PROD_DOCKER_COMPOSE = docker-compose -p $(APP_NAME) -f $(shell pwd)/docker-compose-prod.yml

BACKEND_CONTAINER = $(APP_NAME)_backend_1
MYSQL_CONTAINER = $(APP_NAME)_rds_1
MYSQL_CREDENTIALS = -uroot -pROOT_PASSWORD
MYSQL_DATABASE = $(APP_NAME)_wp
MYSQL_OPTIONS = $(MYSQL_CONTAINER) mysql $(MYSQL_CREDENTIALS) $(MYSQL_DATABASE)

start-devenv:
	$(DEVENV_DOCKER_COMPOSE) up -d

stop-devenv:
	$(DEVENV_DOCKER_COMPOSE) kill

clear-devenv:
	$(DEVENV_DOCKER_COMPOSE) down -v --remove-orphans

build-devenv:
	$(DEVENV_DOCKER_COMPOSE) build

mysql-devenv:
	docker exec -it $(MYSQL_OPTIONS)

start-prod:
	$(DEVENV_DOCKER_COMPOSE) up -d

stop-prod:
	$(DEVENV_DOCKER_COMPOSE) kill

clear-prod:
	$(DEVENV_DOCKER_COMPOSE) down -v --remove-orphans

build-prod:
	$(DEVENV_DOCKER_COMPOSE) build

mysql-prod:
	docker exec -it $(MYSQL_OPTIONS)


