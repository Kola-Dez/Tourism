FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
      apt-utils \
      libpq-dev \
      libpng-dev \
      libzip-dev \
      zip unzip \
      git nginx && \
      docker-php-ext-install -j$(nproc) pdo_mysql gd zip bcmath && \
      apt-get clean && \
      rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- \
    --filename=composer \
    --install-dir=/usr/local/bin

WORKDIR /app/backend

COPY ./_docker/app/php.ini /usr/local/etc/php/conf.d/php.ini
COPY . .

RUN composer install

# Удаляем миграцию и права на файлы из Dockerfile и поместим их в скрипт
# CMD ["php-fpm"]

RUN chmod +x /app/backend/_docker/app/start.sh
RUN chown -R www-data:www-data /app/backend/_docker/app/start.sh

ENTRYPOINT ["/app/backend/_docker/app/start.sh"]
