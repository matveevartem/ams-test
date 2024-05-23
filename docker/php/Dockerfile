FROM php:8.2-fpm

RUN apt update
RUN apt install -y curl zip libzip-dev unzip imagemagick imagemagick-common
RUN apt update


ADD https://raw.githubusercontent.com/mlocati/docker-php-extension-installer/master/install-php-extensions /usr/local/bin/

RUN chmod uga+x /usr/local/bin/install-php-extensions && sync && \
install-php-extensions apcu bcmath exif grpc intl mcrypt opcache pdo_mysql sockets uuid xdebug yaml zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ENV COMPOSER_ALLOW_SUPERUSER=1