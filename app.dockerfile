FROM php:7.4-fpm

RUN apt-get update && apt-get install -y \
	libzip-dev \
    vim \
    curl

RUN curl -fsSL https://deb.nodesource.com/setup_16.x | bash - && \
    apt-get install -y nodejs && \
    ln -s /usr/bin/nodejs /usr/local/bin/node

RUN docker-php-ext-install pdo_mysql mysqli

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
