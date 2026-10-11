#!/bin/bash
set -e

cd /var/www/html

php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan event:clear
php artisan cache:clear

php artisan migrate --force

php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

exec apache2-foreground
