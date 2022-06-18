### Docker helpers
#
# Before using targets please be sure `.env` file is exist.

DOCKER=docker
DOTENV=.env

include $(DOTENV)

.PHONY: build composer php

%:
	@:

### Builds the application image.
build:
	@if [ -f $(DOTENV) ]; then \
		$(DOCKER) build . -t $(APP_NAME); \
	else \
		echo "Error: create $(DOTENV) file in order to build a docker image."; \
	fi

RUNOPTS=run \
	-it --rm \
	--volume $(shell pwd):/var/www \
	--user $(shell id -u):$(shell id -g)

### Run composer.
### Example:
### $ make composer install
### If you need to pass an option use double dash:
### $ make composer -- install --help
composer:
	$(DOCKER) $(RUNOPTS) $(APP_NAME) composer $(filter-out $@,$(MAKECMDGOALS))

php:
	$(DOCKER) $(RUNOPTS) $(APP_NAME) php $(filter-out $@,$(MAKECMDGOALS))

start-server:
	$(DOCKER) $(RUNOPTS) --publish $(SERVER_PORT):$(SERVER_PORT)/tcp $(APP_NAME) composer -- run server

