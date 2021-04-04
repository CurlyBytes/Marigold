# Marigold
Branch information with approval and internet modules


## Pre-requisite 
- Install Docker 


## Run 
to run the application with requirements
``docker
docker-compose up -d --build
``

to open cli on the php  webserver
``
docker exec -it marigold-php-fpm bash
``

`` phpunit test in codeingnier
php vendor/kenjis/ci-phpunit-test/install.php -a src -p public -t tests
``
## Test

##PS 
If you update the autoload psr-4, dont forget to add composer dump-autoload