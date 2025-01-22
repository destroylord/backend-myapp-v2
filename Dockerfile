FROM php:8.2-fpm-alpine

# Install system dependencies
RUN apk add --no-cache \
    unzip \
    curl \
    libpq-dev \
    libzip-dev \
    zip \
    icu-dev \
    && docker-php-ext-install zip pdo pdo_pgsql pcntl intl

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . .

# Set proper permissions for Laravel directories
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Install dependencies and build assets
RUN composer install --no-dev --no-interaction --optimize-autoloader \
    && npm install \
    && npm run build

# Run storage link
RUN php artisan storage:link || true

# Expose port
EXPOSE 9000

# Set the user to www-data for runtime
USER www-data