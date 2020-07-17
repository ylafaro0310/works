FROM php:7.4-apache

COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

RUN apt-get update && \
  docker-php-ext-install pdo_mysql mysqli mbstring && \
  a2enmod rewrite