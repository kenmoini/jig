#!/bin/bash

composer dump-autoload
php artisan cache:clear
php artisan route:clear
php artisan optimize:clear
php artisan clear-compiled
php artisan config:clear