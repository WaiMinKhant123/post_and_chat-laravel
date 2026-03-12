FROM php:8.2-apache

# 1. Install system dependencies & PostgreSQL dev library
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libpq-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql pdo_pgsql

# 2. Enable Apache mod_rewrite for Laravel routing
RUN a2enmod rewrite

# 3. Set working directory
WORKDIR /var/www/html

# 4. Copy project files
COPY . /var/www/html

# 5. Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

COPY . /var/www/html
WORKDIR /var/www/html

# folder အသစ်ဆောက်ပြီး permission ပေးခြင်း
RUN mkdir -p /var/www/html/public/avatars && \
    chown -R www-data:www-data /var/www/html/public/avatars && \
    chmod -R 775 /var/www/html/public/avatars

# Laravel permission အဟောင်းများ
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# ... ကျန်တဲ့ code များ ...

# 7. Change Apache document root to Laravel's public folder
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 8. Expose port 80
EXPOSE 80
