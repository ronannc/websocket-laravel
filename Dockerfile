FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo pdo_pgsql pgsql zip

COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install

# Garante permissões corretas para storage e bootstrap/cache (incluindo arquivos e subpastas)
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap \
    && chmod -R 775 /var/www/storage /var/www/bootstrap

EXPOSE 9000
