FROM registry.access.redhat.com/ubi8/ubi:latest as BUILDER

USER root

# Environmental Variables
ENV COPY_ENV_FILE=true \
    GENERATE_ENV_KEY=true \
    GENERATE_SQLITE_DB=true \
    MIGRATE_DATABASE=true \
    SEED_INITIAL_ADMIN=true \
    SEED_DATABASE=true \
    COPY_ENV_FILE_FROM_CONFIGMAP=false \
    GENERATE_SHOW_NEW_ENV_KEY=false \
    PATH=/opt/app-root/bin/:$PATH

# Update image
RUN yum update -y --disablerepo=* --enablerepo=ubi-8-appstream --enablerepo=ubi-8-baseos \
 && rm -rf /var/cache/yum

# Install NPM and PHP
RUN yum install -y --disablerepo=* --enablerepo=ubi-8-appstream --enablerepo=ubi-8-baseos npm nodejs nodejs-devel autoconf automake binutils gcc gcc-c++ gdb glibc-devel libtool make pkgconf pkgconf-m4 pkgconf-pkg-config redhat-rpm-config rpm-build-libs git wget curl php php-fpm php-cli php-pgsql php-devel php-xml php-json php-pdo php-mysqlnd php-bcmath php-gd php-xmlrpc php-soap php-mbstring \
 && rm -rf /var/cache/yum

# Clear Image
RUN rm -rf /var/www/html \
 && mkdir -p /var/www/html/public \
 && mkdir -p /var/log/php-fpm \
 && mkdir -p /opt/app-root/bin

# Get Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
 && php composer-setup.php \
 && php -r "unlink('composer-setup.php');" \
 && mv composer.phar /opt/app-root/bin/composer

# Copy files
COPY builder-root/ /
COPY app-src/ /var/www/html/

WORKDIR "/var/www/html"

# Run builds
RUN composer install

RUN npm install \
 && npm run dev

## Finished building application

FROM registry.access.redhat.com/ubi8/ubi:latest

USER root

# Environmental Variables
ENV COPY_ENV_FILE=true \
    GENERATE_ENV_KEY=true \
    GENERATE_SQLITE_DB=true \
    MIGRATE_DATABASE=true \
    SEED_INITIAL_ADMIN=true \
    SEED_DATABASE=true \
    COPY_ENV_FILE_FROM_CONFIGMAP=false \
    GENERATE_SHOW_NEW_ENV_KEY=false \
    PATH=/opt/app-root/bin/:$PATH \
    APP_ROOT=/opt/app-root \
    HOME=/opt/app-root

#labels for container catalog
LABEL summary="Jig is an application that is used to power engaging workshops."
LABEL description="Jig is an application that is used to power engaging workshops."
LABEL io.k8s.display-name="Jig - Workshop Worker"
LABEL io.openshift.expose-services="8080:http"
LABEL io.openshift.tags="jig,workshops"

# Update image
RUN yum update -y --disablerepo=* --enablerepo=ubi-8-appstream --enablerepo=ubi-8-baseos \
 && rm -rf /var/cache/yum

# Install Nginx and PHP
RUN yum install -y --disablerepo=* --enablerepo=ubi-8-appstream --enablerepo=ubi-8-baseos nginx python3-pip php php-fpm php-cli php-pgsql php-devel php-xml php-json php-pdo php-mysqlnd php-bcmath php-gd php-xmlrpc php-soap php-mbstring \
 && rm -rf /var/cache/yum \
 && pip3 install supervisor

# Clear Image
RUN rm -rf /etc/nginx/sites-enabled/default \
 && rm -rf /var/www/html \
 && mkdir -p /etc/supervisor/conf.d/ \
 && mkdir -p /etc/nginx/sites-enabled/ \
 && mkdir -p /var/www/html/public \
 && mkdir -p /var/log/php-fpm \
 && mkdir -p /opt/app-root/bin

COPY container-root/ /
COPY --from=BUILDER /var/www/html /var/www/html
COPY --from=BUILDER /opt/app-root/bin /opt/app-root/bin

WORKDIR "/var/www/html"

# Drop the root user and make the content of /opt/app-root owned by user 1001
RUN mkdir -p /var/www/data && \
    chown -R 1001:0 /var/www/ && chmod -R ug+rwx /var/www/ && \
    chown -R 1001:0 ${APP_ROOT} && chmod -R ug+rwx ${APP_ROOT} && \
    rpm-file-permissions

USER 1001

EXPOSE 8080

CMD ["/opt/start.sh"]