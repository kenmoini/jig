#!/bin/bash

composer install
npm install
npm run dev

FILE=.env
if [ -f "$FILE" ]; then
    echo "Env file found!"
else
    cp .env.example .env
    php artisan key:generate
    php artisan migrate
    composer dump-autoload
fi

echo "Now log in, create a user, then come back and run:"
echo "php artisan db:seed"