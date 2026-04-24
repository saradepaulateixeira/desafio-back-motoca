FROM php:8.4-fpm

ARG DEBIAN_FRONTEND=noninteractive

RUN apt-get update && apt-get install -y \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    unzip \
    git \
    curl \
    libonig-dev \
    nodejs \
    npm \
    libpq-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_pgsql pgsql zip gd \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

RUN mkdir -p /var/www/html/storage/framework/{sessions,views,cache} \
    && mkdir -p /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache \
    && chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

RUN touch /var/www/html/.env \
    && echo "upload_tmp_dir = /var/www/html/storage/tmp" >> /usr/local/etc/php/php.ini \
    && echo "sys_temp_dir = /var/www/html/storage/tmp" >> /usr/local/etc/php/php.ini \
    && mkdir -p /var/www/html/storage/tmp \
    && chmod 777 /var/www/html/storage/tmp

EXPOSE 9000

CMD ["php-fpm"]