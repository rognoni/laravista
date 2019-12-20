FROM php:7.1-apache

RUN a2enmod rewrite
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN apt-get update && apt-get install -y zip unzip vim
RUN docker-php-ext-install pdo pdo_mysql

COPY config/php.ini /usr/local/etc/php/
