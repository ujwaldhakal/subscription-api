
## Steps to setup
* docker run --rm -v $(pwd):/app composer install
* cp .env.example .env
* chmod -R 777 storage
* docker-compose exec app php artisan key:generate
