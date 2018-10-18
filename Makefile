SHELL := /bin/bash

test:
	php vendor/phpunit/phpunit/phpunit -vvv

setup: composer passport npm
	echo "setup is complete"

composer:
	composer install

npm:
	npm install

passport:
	composer require laravel/passport
	php artisan migrate
	php artisan passport:install
