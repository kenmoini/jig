#/bin/bash

cp .env.example .env

php artisan key:generate
php artisan migrate

exec /start.sh