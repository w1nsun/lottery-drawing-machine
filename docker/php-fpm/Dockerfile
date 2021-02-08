FROM php:7.4.15-fpm-buster

RUN apt-get update \
    && apt-get install -y wget git curl zip unzip libz-dev libzip-dev libicu-dev libonig-dev libsqlite3-dev \
    && apt-get autoremove -y

RUN docker-php-ext-install -j$(nproc) iconv \
       && docker-php-ext-install pcntl \
       && docker-php-ext-install intl \
       && docker-php-ext-install mbstring \
       && docker-php-ext-install zip \
       && docker-php-ext-install bcmath \
       && docker-php-ext-install sockets \
       && docker-php-ext-install pdo pdo_mysql pdo_sqlite \
       && docker-php-source delete \
       && rm -rf /tmp/* /var/tmp/* /var/cache/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

