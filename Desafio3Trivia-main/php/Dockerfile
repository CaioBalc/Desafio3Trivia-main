# docker build -t perguntas .
# docker run -dp 8080:80 -v /home/imply/Documentos/GitHub/Desafio3Trivia-main/php:/var/www/html --name perguntas php
# docker run -dp 8080:80 -v C:\Users\balcz\Documents\GitHub\Desafio3Trivia-main\php:/var/www/html --name perguntas php

FROM php:8.3.2-apache

WORKDIR /var/www/html

RUN apt-get update

# Drivers PDO E PGSQL
RUN apt-get install -y libpq-dev \
  && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
  && docker-php-ext-install pdo pdo_pgsql pgsql

# docker build -t nomedaimagem .
#docker run -dp 8080:80 nomedaimagem
#5docker ps e docker ps -a
#service postgresql status
#netstat -an | grep 5431
#docker compose up
#psql -h localhost -p 8101 -U postgres db
#sudo apt-get install php-pgsql