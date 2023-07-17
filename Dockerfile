# Use the official PHP 8.1 image
FROM php:8.1-fpm

# Set the working directory in the container
WORKDIR /var/www/html

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y libonig-dev zip libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring zip exif gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Node.js (if your Laravel application uses frontend assets)
# RUN apt-get install -y npm

# Copy Laravel application files to the container
COPY . /var/www/html

# Install Laravel dependencies
RUN composer install

# Set permissions for Laravel directories (if needed)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 9000 for PHP-FPM (adjust if needed)
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
