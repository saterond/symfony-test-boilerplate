# symfony-test-boilerplate

Boilerplate Symfony project for basic types of testing

## Features
- skeleton Symfony 3.0 project with all prerequisities for running PHPUnit tests on controllers
- boostrap PHP script for preparing testing environment with fixtures and service container
- follows Symfony best practices

## Installation

1. clone repository
2. run `composer install`
3. update parameters in **app/config/parameters.yml**
4. run `./bin/console doctrine:schema:create`
5. generate password for a user with command `./bin/console security:encode-password PASSWORD AppBundle\\Entity\\User`
6. create a user in database with the generated password hash

## Usage

1. start server by `./bin/console server:run`
2. open [http://localhost:8000](http://localhost:8000) in your browser
3. navigate to URL [http://localhost:8000/secured-area](http://localhost:8000/secured-area) and you should be able to sign in with your user's credentials
4. run `phpunit` - everything should be green
