#!/bin/bash

# Выполняем миграции
composer install

# Устанавливаем права на файлы
chmod -R 775 /app/backend/storage
chown -R www-data:www-data /app/backend/storage

chmod -R 775 bootstrap/cache
chown -R www-data:www-data bootstrap/cache

php artisan storage:link
php artisan l5-swagger:generate

# Запускаем php-fpm
php-fpm
