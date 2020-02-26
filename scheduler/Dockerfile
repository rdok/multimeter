FROM php:7.4-cli-alpine3.11

COPY cron /etc/cron.d/cron

# RUN service cron start

WORKDIR /app

# from composer install
#COPY composer.json composer.lock ./
#RUN composer install --no-dev

COPY . .
