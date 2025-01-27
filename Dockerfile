FROM php:8.2-fpm-alpine

# Install system dependencies
RUN apk add --no-cache \
    unzip \
    curl \
    libpq-dev \
    libzip-dev \
    zip \
    icu-dev \
    nodejs \
    nano \
    npm \
    && docker-php-ext-configure intl \
    && docker-php-ext-install -j$(nproc) zip pdo pdo_pgsql pcntl intl

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html 

# Copy composer files first
COPY composer.json composer.lock ./

# Install composer dependencies
RUN composer install --no-dev --no-interaction --optimize-autoloader

# Copy package files
COPY package*.json ./

# Install npm dependencies
RUN npm ci

# Copy entire application
COPY . .

# Build npm
RUN npm run build

# Set permissions
RUN mkdir -p storage bootstrap/cache && \
    chown -R www-data:www-data storage bootstrap/cache

# Run storage link
RUN php artisan storage:link || true

# Expose port
EXPOSE 9000

# Entrypoint
CMD ["php-fpm"]
