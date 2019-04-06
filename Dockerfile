FROM wordpress:php7.1-apache

COPY --chown=www-data:www-data ./wp-content/themes/an-theme /var/www/html/wp-content/themes/an-theme
COPY --chown=www-data:www-data ./wp-content/plugins/sdp-post-types /var/www/html/wp-content/plugins/sdp-post-types
