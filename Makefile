### Docker helpers
#
# Before using targets please be sure `.env` file is exist.

DOCKER=docker

include .env

.PHONY: build composer php

%:
	@:

### Builds the application image.
build:
	$(DOCKER) build . -t $(APP_NAME)

RUNOPTS=run \
	-it --rm \
	--volume $(shell pwd):/var/www \
	--user $(shell id -u):$(shell id -g) \
	--publish $(SERVER_PORT):$(SERVER_PORT)/tcp \
	$(APP_NAME)

### Run composer.
### Example:
### $ make composer install
### If you need to pass an option use double dash:
### $ make composer -- install --help
composer:
	$(DOCKER) $(RUNOPTS) composer $(filter-out $@,$(MAKECMDGOALS))

php:
	$(DOCKER) $(RUNOPTS) php $(filter-out $@,$(MAKECMDGOALS))
