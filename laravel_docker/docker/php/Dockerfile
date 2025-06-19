# docker/php/Dockerfile
FROM php:8.3-fpm

# 基本ツールインストール
RUN apt-get update && \
    apt-get install -y \
    zlib1g-dev \
    mariadb-client \
    vim \
    libzip-dev \
    cron \
    && docker-php-ext-install zip pdo_mysql

# Composerインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# crontab設定
COPY crontab /etc/cron.d/laravel-cron
RUN chmod 0644 /etc/cron.d/laravel-cron && \
    touch /var/log/cron.log

WORKDIR /var/www