FROM php:8.3-apache

# Configure Apache document root to /public
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN a2enmod rewrite \
    && echo "ServerName localhost" >> /etc/apache2/apache2.conf \
    && sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf \
    && printf "\n<Directory ${APACHE_DOCUMENT_ROOT}>\n    AllowOverride All\n    Require all granted\n</Directory>\n" >> /etc/apache2/apache2.conf

# Install system dependencies + PHP extensions
RUN apt-get update \
    && apt-get install -y git unzip libzip-dev libonig-dev \
    && docker-php-ext-install zip mbstring \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy application source code
WORKDIR /var/www/html
COPY . /var/www/html

# Fix storage permissions
RUN mkdir -p storage/framework/{sessions,cache,views} \
    && chown -R www-data:www-data storage bootstrap/cache

# Remove Collision service provider from production
RUN sed -i "/NunoMaduro\\\\\\\\Collision\\\\\\\\Adapters\\\\\\\\Laravel\\\\\\\\CollisionServiceProvider/d" config/app.php

# Install production dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

EXPOSE 80
CMD ["apache2-foreground"]
