#!/bin/bash

# Выполняем миграции
composer install
php artisan migrate
php artisan db:seed --class=DatabaseSeeder

# Устанавливаем права на файлы
chmod -R 775 /app/backend/storage
chown -R www-data:www-data /app/backend/storage

chmod -R 775 bootstrap/cache
chown -R www-data:www-data bootstrap/cache

php artisan storage:link

# Запускаем php-fpm
php-fpm
