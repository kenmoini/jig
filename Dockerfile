FROM harbor.polyglot.host/polyglot-academy/pa-nginx-php-node-base:latest

COPY app-src/ /var/www/html/
WORKDIR /var/www/html/

ENV CACHEBUSTER=LVL3

RUN composer install \
 && npm install \
 && npm run dev

COPY init-cmd.sh /opt/init-cmd.sh

RUN chown -R www-data:www-data /var/www/html

EXPOSE 80

CMD /opt/init-cmd.sh