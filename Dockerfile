# Build Stage
FROM php:8.2-fpm as build

# Install dependencies & Composer
RUN apt-get update && apt-get install -y ... # as before

# Copy and build
WORKDIR /var/www
COPY . .
RUN cp .env.example .env \
    && composer install --no-dev --optimize-autoloader \
    && php artisan key:generate

# Final Stage
FROM php:8.2-fpm

# Only required extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    curl \
    libzip-dev \
    libpq-dev \
    mysql-client \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

COPY --from=build /usr/bin/composer /usr/bin/composer
COPY --from=build /var/www /var/www

WORKDIR /var/www
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 8000
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
