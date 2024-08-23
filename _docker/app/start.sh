#!/bin/bash

# Выполняем миграции
php artisan migrate

# Устанавливаем права на файлы
chmod -R 775 /app/backend/storage
chown -R www-data:www-data /app/backend/storage

chmod -R 775 bootstrap/cache
chown -R www-data:www-data bootstrap/cache


# Запускаем php-fpm
php-fpm
