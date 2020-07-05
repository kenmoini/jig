#/bin/bash

if [ $COPY_ENV_FILE = "true" ]; then
    cp .env.example .env
fi

if [ $COPY_ENV_FILE_FROM_CONFIGMAP = "true" ]; then
    cp /var/html/data/.env .env
fi

if [ $GENERATE_SQLITE_DB = "true" ]; then
    touch /var/www/html/local_db/db.sqlite
    sed -i "s,DB_DATABASE=.*,DB_DATABASE=/var/www/html/local_db/db.sqlite,g" .env
fi

if [ $GENERATE_ENV_KEY = "true" ]; then
    php artisan key:generate
fi

if [ $MIGRATE_DATABASE = "true" ]; then
    php artisan migrate
fi

composer dump-autoload

if [ $SEED_INITIAL_ADMIN = "true" ]; then
    php artisan db:seed --class=AdminUserSeeder
fi

if [ $SEED_DATABASE = "true" ]; then
    php artisan db:seed
fi

exec /usr/libexec/s2i/run