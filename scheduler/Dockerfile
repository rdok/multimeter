FROM php:7.4-cli-alpine3.11

COPY cron /etc/cron.d/cron

# RUN service cron start

WORKDIR /app
COPY . .
