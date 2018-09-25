SHELL := /bin/bash

test:
	php vendor/phpunit/phpunit/phpunit -vvv;
