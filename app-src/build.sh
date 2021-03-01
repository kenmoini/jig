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
    composer dump-autoload
fi

php artisan initial-setup:run

chown apache:apache -R .
chmod 775 -R storage