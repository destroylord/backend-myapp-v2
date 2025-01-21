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

# Set permissions
RUN apk add --no-cache nodejs npm && \
    chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache && \
    npm install && \
    npm run build && \
    composer install --no-dev --no-interaction --optimize-autoloader

# Expose port
EXPOSE 9000