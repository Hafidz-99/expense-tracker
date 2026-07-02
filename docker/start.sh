#!/usr/bin/env bash
set -e

export PORT="${PORT:-10000}"

envsubst '$PORT' < /etc/nginx/templates/default.conf.template > /etc/nginx/conf.d/default.conf

cd /var/www/html

php artisan package:discover --ansi
php artisan storage:link || true
php artisan migrate --force

php artisan config:cache
php artisan view:cache

php-fpm -D
nginx -g "daemon off;"
