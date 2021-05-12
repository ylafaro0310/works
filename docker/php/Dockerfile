FROM php:7.2-apache-stretch
RUN apt-get update \
    #&& apt-get install -y libpq-dev \
    && docker-php-ext-install pdo_mysql 

#COPY entrypoint.sh /usr/local/bin/entrypoint.sh
#RUN chmod +x /usr/local/bin/entrypoint.sh
#ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]