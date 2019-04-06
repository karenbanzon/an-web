FROM wordpress:php7.1-apache

COPY ./wp-content/themes/an-theme /var/www/html/wp-content/themes/an-theme
COPY ./wp-content/plugins/sdp-post-types /var/www/html/wp-content/plugins/sdp-post-types

RUN chown -R www-data:www-data /var/www/html/wp-content/wp-content/