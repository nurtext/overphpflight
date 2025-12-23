FROM php:8.5-cli-alpine

COPY ./src/router.php /srv/www/router.php
EXPOSE 8080
VOLUME /srv/www/img
WORKDIR /srv/www

CMD [ "php", "-S", "0.0.0.0:8080", "./router.php" ]
