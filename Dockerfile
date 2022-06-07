FROM composer:latest AS composer
COPY . .
RUN composer install --no-dev

FROM  php:8-apache
COPY --from=composer /app /var/www/html
