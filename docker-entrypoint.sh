#!/bin/sh
set -e

# Ensure runtime directories exist
mkdir -p /var/www/html/application/cache/sessions
mkdir -p /var/www/html/application/logs
mkdir -p /var/www/html/assets/img
mkdir -p /var/www/html/assets/uploads/pdf

# Ensure correct permissions for web server
chown -R www-data:www-data /var/www/html/application/cache
chown -R www-data:www-data /var/www/html/application/logs
chown -R www-data:www-data /var/www/html/assets/img
chown -R www-data:www-data /var/www/html/assets/uploads
chmod -R 775 /var/www/html/assets/uploads
chmod -R 775 /var/www/html/assets/img

exec "$@"
