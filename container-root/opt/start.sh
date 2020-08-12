#!/bin/bash

if [ $COPY_ENV_FILE = "true" ]; then
    cp .env.example .env
fi

if [ $COPY_ENV_FILE_FROM_CONFIGMAP = "true" ]; then
    ln -s /var/www/data/.env /var/www/html/.env
fi

if [ $GENERATE_SQLITE_DB = "true" ]; then
    touch /var/www/data/db.sqlite
    sed -i "s,DB_DATABASE=.*,DB_DATABASE=/var/www/data/db.sqlite,g" .env
fi

if [ $GENERATE_SHOW_NEW_ENV_KEY = "true" ]; then
    echo "New Application key:"
    php artisan key:generate --show
    echo "COPY TO YOUR CONFIGMAP FOR A NEW APPLICATION KEY!"
fi

if [ $GENERATE_ENV_KEY = "true" ]; then
    php artisan key:generate
fi

if [ $MIGRATE_DATABASE = "true" ]; then
    php artisan migrate --force
fi

composer dump-autoload

if [ $SEED_INITIAL_ADMIN = "true" ]; then
    php artisan db:seed --class=AdminUserSeeder
fi

if [ $SEED_DATABASE = "true" ]; then
    php artisan db:seed
fi

# Enable custom nginx config files if they exist
if [ -f /var/www/html/conf/nginx/nginx.conf ]; then
  cp /var/www/html/conf/nginx/nginx.conf /etc/nginx/nginx.conf
fi

if [ -f /var/www/html/conf/nginx/nginx-site.conf ]; then
  cp /var/www/html/conf/nginx/nginx-site.conf /etc/nginx/sites-available/default.conf
fi

# Pass real-ip to logs when behind ELB, etc
if [[ "$REAL_IP_HEADER" == "1" ]] ; then
 sed -i "s/#real_ip_header X-Forwarded-For;/real_ip_header X-Forwarded-For;/" /etc/nginx/sites-available/default.conf
 sed -i "s/#set_real_ip_from/set_real_ip_from/" /etc/nginx/sites-available/default.conf
 if [ ! -z "$REAL_IP_FROM" ]; then
  sed -i "s#172.16.0.0/12#$REAL_IP_FROM#" /etc/nginx/sites-available/default.conf
 fi
fi

# Run custom scripts
if [[ "$RUN_SCRIPTS" == "1" ]] ; then
  if [ -d "/var/www/html/scripts/" ]; then
    # make scripts executable incase they aren't
    chmod -Rf 750 /var/www/html/scripts/*; sync;
    # run scripts in number order
    for i in `ls /var/www/html/scripts/`; do /var/www/html/scripts/$i ; done
  else
    echo "Can't find script directory"
  fi
fi

# Start supervisord and services
exec /usr/local/bin/supervisord -n -c /etc/supervisord.conf