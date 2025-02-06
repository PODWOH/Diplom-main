FROM php:8.3-fpm

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
build-essential \
libpng-dev \
libjpeg-dev \
libonig-dev \
libfreetype6-dev \
libwebp-dev \
zlib1g-dev \
libzip-dev \
libcurl4-openssl-dev \
zip \
curl \
unzip \
git \
supervisor \
nginx \
default-mysql-client

# Устанавливаем Node.js версии 20
RUN curl -sL https://deb.nodesource.com/setup_20.x | bash -
RUN apt-get install -y nodejs

RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath opcache
RUN pecl install apcu && docker-php-ext-enable apcu

# Устанавливаем Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY ./docker/php/php.ini /usr/local/etc/php/conf.d/php.ini
COPY ./docker/php/www.conf /usr/local/etc/php-fpm.d/www.conf

CMD ["php-fpm"]

EXPOSE 9000