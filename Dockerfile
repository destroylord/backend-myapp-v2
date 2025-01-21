FROM php:8.2-fpm-alpine

# Install system dependencies
RUN apk add --no-cache \
    git \
    unzip \
    curl \
    libzip-dev \
    zip \
    && docker-php-ext-install zip pdo pdo_mysql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . .

# Set permissions
RUN chown -R www-data:www-data storage bootstrap/cache /var/www/html \
    && chmod -R 775 storage bootstrap/cache /var/www/html

# Expose port
EXPOSE 9000