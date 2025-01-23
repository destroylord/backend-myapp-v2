# FROM php:8.2-fpm-alpine

# # Install system dependencies
# RUN apk add --no-cache \
#     unzip \
#     curl \
#     libpq-dev \
#     libzip-dev \
#     zip \
#     icu-dev \
#     nodejs \
#     nano \
#     npm \
#     && docker-php-ext-configure intl \
#     && docker-php-ext-install -j$(nproc) zip pdo pdo_pgsql pcntl intl

# # Install Composer
# COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# # Set working directory
# WORKDIR /var/www/html

# # Copy application files
# COPY . /var/www/html

# # Set permissions
# RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# # Install PHP dependencies
# RUN composer install --no-dev --no-interaction --optimize-autoloader

# # Install Node.js dependencies and build assets
# RUN npm install && npm run build

# # Run storage link
# RUN php artisan storage:link || true

# # Expose port
# EXPOSE 9000

# # Set the user to www-data for runtime
# CMD ["php-fpm"]
# Define the base image
FROM teguh02/laravel-filament:latest

# Set user to root
USER root

# Change the working directory
WORKDIR /var/www

# Remove the all files in the /var/www/html directory
RUN rm -rf /var/www/html/*

# Copy laravel public directory to the /var/www/html directory
COPY ./public /var/www/html

# Copy the project files to the /var/www directory
COPY . /var/www

# Install the project dependencies
RUN composer install 
RUN npm install

# Build the vite
RUN npm run build

# Change the directory permission
RUN chmod -R 777 /var/www

# If you want to change the timezone of the container to UTC
# RUN sed -i 's/;date.timezone =/date.timezone = UTC/g' /etc/php/8.3/fpm/php.ini
# RUN sed -i 's/;date.timezone =/date.timezone = UTC/g' /etc/php/8.3/cli/php.ini

# If you want to display the error message
RUN sed -i 's/display_errors = Off/display_errors = On/g' /etc/php/8.3/fpm/php.ini
RUN sed -i 's/display_errors = Off/display_errors = On/g' /etc/php/8.3/cli/php.ini
RUN sed -i 's/error_reporting = E_ALL & ~E_DEPRECATED & ~E_STRICT/error_reporting = E_ALL/g' /etc/php/8.3/fpm/php.ini
