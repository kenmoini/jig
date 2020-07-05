FROM registry.access.redhat.com/ubi7/php-73:latest

USER root

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

RUN chown -R $(id -u):$(id -g) .

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
 && php composer-setup.php \
 && php -r "unlink('composer-setup.php');" \
 && echo $PATH \
 && mkdir /opt/app-root/bin/ \
 && mv composer.phar /opt/app-root/bin/composer

RUN composer install

RUN npm install \
 && npm run dev \
 && mkdir /var/www/html/local_db/ \
 && chmod 777 /var/www/html/local_db/

COPY apache-vhost.conf /opt/app-root/etc/conf.d/site.conf
COPY init-cmd.sh /var/www/html/init-cmd.sh

# Drop the root user and make the content of /opt/app-root owned by user 1001
RUN chown -R 1001:0 /var/www/ && chmod -R ug+rwx /var/www/ && \
    chown -R 1001:0 ${APP_ROOT} && chmod -R ug+rwx ${APP_ROOT} && \
    rpm-file-permissions

USER 1001

CMD /var/www/html/init-cmd.sh