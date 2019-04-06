FROM wordpress:php7.1-apache

COPY --chown=www-data:www-data ./wp-content /var/www/html/wp-content
