all: install build static run

install:
	bash install.sh

build:
	docker-compose -f ci/docker/local.yaml build base
	docker-compose -f ci/docker/local.yaml build --no-cache --build-arg hostUID=`id -u` --build-arg hostGID=`id -g` web

image:
	docker build -f ci/docker/Dockerfile.base --build-arg PHP_ENV=development --tag vinhvo:base .
	docker build -f ci/docker/Dockerfile --build-arg PHP_ENV=development --tag registry.saritasa.com/vinhvo/backend:develop .

start: run

run:
	docker-compose -f ci/docker/local.yaml -p vinhvo up -d web

stop:
	docker-compose -f ci/docker/local.yaml -p vinhvo kill

destroy:
	docker-compose -f ci/docker/local.yaml -p vinhvo down

logs:
	docker-compose -f ci/docker/local.yaml -p vinhvo logs -f web

shell:
	docker-compose -f ci/docker/local.yaml -p vinhvo exec --user nginx web bash

root:
	docker-compose -f ci/docker/local.yaml -p vinhvo exec web bash

cs:
	docker exec -it -w /home/www/app vinhvo-web php vendor/bin/phpcs --parallel=4

csfix:
	docker exec -it -w /home/www/app vinhvo-web php vendor/bin/phpcbf --parallel=4

test:
	docker exec -it -w /home/www/app vinhvo-web php vendor/bin/phpunit

test2:
	docker-compose -f ci/docker/testing_local.yml -p vinhvo_tests run --rm tests
	docker-compose -f ci/docker/testing_local.yml -p vinhvo_tests down

static:
	ci/yarn run development

watch:
	ci/yarn run watch

lint:
	ci/yarn run lint

lintfix:
	ci/yarn run lint:fix

swagger:
	npx swagger-cli validate docs/API/index.yaml
	npx swagger-cli bundle --type yaml --outfile public/swagger-ui/api.yaml docs/API/index.yaml

ip:
	update_ip.sh vinhvo-web
	update_ip.sh vinhvo-db

