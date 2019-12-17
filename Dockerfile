FROM php:7.1-apache

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apt-get update && apt-get install -y zip unzip vim

COPY config/php.ini /usr/local/etc/php/
