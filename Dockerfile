FROM php:8.2-apache

# 1. System Dependencies & PostgreSQL Driver သွင်းခြင်း
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

# 2. Apache mod_rewrite ကို ဖွင့်ခြင်း
RUN a2enmod rewrite

# 3. Working Directory သတ်မှတ်ခြင်း
WORKDIR /var/www/html

# 4. Project files များကို ကူးယူခြင်း
COPY . /var/www/html

# 5. Composer သွင်းပြီး dependencies များ install လုပ်ခြင်း
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# 6. ပုံတင်မည့် folder များဆောက်ပြီး Permission ပေးခြင်း
# avatars ရော media ရော တစ်ခါတည်း ဆောက်ပြီး permission ပေးထားပါတယ်
RUN mkdir -p /var/www/html/public/avatars /var/www/html/public/media && \
    chown -R www-data:www-data /var/www/html/public/avatars /var/www/html/public/media && \
    chmod -R 775 /var/www/html/public/avatars /var/www/html/public/media
RUN php artisan storage:link
# 7. Laravel Storage နှင့် Cache အတွက် Permission ပေးခြင်း
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# 8. Apache Document Root ကို public folder သို့ ပြောင်းခြင်း
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 9. Port 80 ကို ဖွင့်ခြင်း
EXPOSE 80
