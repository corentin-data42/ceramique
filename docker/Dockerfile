FROM php:8.2-fpm
USER root

#RUN useradd -ms /bin/bash -g www-data dockeruser
#RUN chown -R dockeruser:www-data /var/www

RUN apt-get update && apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libmcrypt-dev libpng-dev curl libonig-dev libicu-dev

#installation extension php

RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl
RUN docker-php-ext-enable intl
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-enable pdo_mysql

#RUN docker-php-ext-install pdo_sqlite
#RUN docker-php-ext-enable pdo_sqlite
#RUN docker-php-ext-install opcache pdo pdo_mysql mysqli
#RUN docker-php-ext-enable opcache pdo pdo_mysql mysqli
#RUN pecl install apcu
#RUN docker-php-ext-enable apcu
#RUN pecl install xdebug
#RUN docker-php-ext-enable xdebug

#install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
COPY php.ini /usr/local/etc/php/php.ini
#test
HEALTHCHECK CMD curl --fail http://localhost/index.php || exit 1

USER www-data


