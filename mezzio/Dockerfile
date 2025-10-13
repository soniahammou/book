FROM php:8.4-apache

RUN apt update
RUN apt install -y libzip-dev zip
RUN docker-php-ext-install zip

WORKDIR /var/www/html

COPY . .

#installation de composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN composer install --no-interaction --optimize-autoloader

# Apache sert depuis /public
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

EXPOSE 80

RUN a2enmod rewrite

CMD ["apache2-foreground"]
