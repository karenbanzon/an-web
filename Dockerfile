FROM wordpress:php7.1-apache

COPY --chown=www-data:www-data ./wp-content/themes/an-theme /tmp/an-theme
COPY --chown=www-data:www-data ./wp-content/plugins/sdp-post-types /tmp/sdp-post-types
