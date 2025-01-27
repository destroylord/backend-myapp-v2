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
    npm \
    && docker-php-ext-configure intl \
    && docker-php-ext-install -j$(nproc) zip pdo pdo_pgsql pcntl intl

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html 

# Copy composer files dan install dependencies (PENTING UNTUK CACHING)
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --optimize-autoloader

# Copy aplikasi (kecuali public) ke direktori app
RUN mkdir app
COPY . app/
RUN rm -rf app/public

# Copy isi public ke root /var/www/html
COPY ./public/. /var/www/html/

# Jalankan npm di dalam folder app
RUN npm --prefix ./app install && npm --prefix ./app run build

# Set permissions (PERBAIKAN PENTING)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Run storage link (modifikasi path)
RUN php /var/www/app/artisan storage:link || true

# Expose port
EXPOSE 9000

# Entrypoint
CMD ["php-fpm"]