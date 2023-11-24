FROM php:8.2-apache

RUN docker-php-ext-install \
    pdo_mysql \
    && a2enmod \
    rewrite

# Оновлюємо пакетні списки та встановлюємо nano
RUN apt-get update && apt-get install -y nano \
    git \
    unzip \
    redis-tools \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
