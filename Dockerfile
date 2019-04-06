FROM wordpress:php7.1-apache

RUN chown -R root:root wp-content
RUN rm -rf /var/www/html/wp-content/themes/an-theme
RUN rm -rf /var/www/html/wp-content/plugins/sdp-post-types

COPY ./wp-content/themes/an-theme /var/www/html/wp-content/themes/an-theme
COPY ./wp-content/plugins/sdp-post-types /var/www/html/wp-content/plugins/sdp-post-types

RUN chown -R www-data:www-data wp-content