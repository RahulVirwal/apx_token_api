# Use official PHP image with required extensions
FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl zip unzip libzip-dev \
    libonig-dev libxml2-dev libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application source
COPY . .

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Set correct permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Expose the Laravel port
EXPOSE 8000

# Start Laravel's built-in server
CMD php artisan serve --host=0.0.0.0 --port=8000
