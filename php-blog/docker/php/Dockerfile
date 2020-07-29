FROM php:7.4-apache

COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

RUN apt-get update && \
  apt-get install -y libonig-dev && \
  docker-php-ext-install pdo_mysql mysqli && \
  a2enmod rewrite