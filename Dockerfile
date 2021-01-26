FROM php:8.0.0rc1-fpm
RUN docker-php-ext-install pdo pdo_mysql
WORKDIR /var/www
ADD ./ /var/www/
EXPOSE 9000
CMD ["php-fpm"]
