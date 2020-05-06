FROM php:7.4-apache
RUN apt update
RUN apt upgrade -y
RUN apt install -y apt-utils
RUN apt install -y curl
RUN apt install -y libpq-dev
RUN apt install -y libcurl4
RUN apt install -y libcurl4-openssl-dev
RUN docker-php-ext-install pgsql
RUN docker-php-ext-install curl
COPY src/ /var/www/html/
COPY config/php.ini $PHP_INI_DIR/conf.d/