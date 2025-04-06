FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# www-dataユーザーのホームディレクトリとPsySH設定ディレクトリを作成
RUN mkdir -p /var/www/.config/psysh && \
    chown -R www-data:www-data /var/www && \
    chmod -R 755 /var/www

RUN echo "display_errors = On" >> /usr/local/etc/php/conf.d/error-logging.ini \
    && echo "error_reporting = E_ALL" >> /usr/local/etc/php/conf.d/error-logging.ini

EXPOSE 9000

USER www-data

CMD ["php-fpm"]