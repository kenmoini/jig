FROM registry.access.redhat.com/ubi7/php-73:latest

COPY app-src/ /var/www/html/
WORKDIR /var/www/html/

ENV NODEJS_VERSION=10

ENV CACHEBUSTER=LVL3 \
    PATH=/opt/rh/rh-nodejs$NODEJS_VERSION/root/usr/bin:$HOME/node_modules/.bin/:$HOME/.npm-global/bin/:$PATH

ENV COPY_ENV_FILE=true \
    GENERATE_ENV_KEY=true \
    GENERATE_SQLITE_DB=true \
    MIGRATE_DATABASE=true \
    SEED_INITIAL_ADMIN=true \
    SEED_DATABASE=true

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
 && php composer-setup.php \
 && php -r "unlink('composer-setup.php');" \
 && echo $PATH \
 && mkdir /opt/app-root/bin/ \
 && mv composer.phar /opt/app-root/bin/composer

RUN composer install

RUN npm install \
 && npm run dev \
 && mkdir /var/www/jig-db/

COPY apache-vhost.conf /opt/app-root/etc/conf.d/site.conf
COPY init-cmd.sh /var/www/html/init-cmd.sh

USER ROOT

# Reset permissions of filesystem to default values
RUN /usr/libexec/container-setup && rpm-file-permissions

USER 1001

CMD /var/www/html/init-cmd.sh