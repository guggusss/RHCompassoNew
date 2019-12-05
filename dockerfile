FROM php:7.2-apache

RUN  apt-get update && apt-get install libldap2-dev -y && docker-php-ext-install ldap && \
     docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable mysqli && docker-php-ext-enable pdo_mysql

EXPOSE 80