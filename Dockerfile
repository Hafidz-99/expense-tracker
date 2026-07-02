FROM php:8.4-fpm-bookworm

# Install system packages, Nginx, PostgreSQL/MySQL PHP drivers, and Node.js 22
RUN apt-get update && apt-get install -y ca-certificates curl gnupg \
    && curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get update && apt-get install -y \
    nginx \
    git \
    zip \
    unzip \
    libpq-dev \
    libzip-dev \
    gettext-base \
    nodejs \
    && docker-php-ext-install pdo_mysql pdo_pgsql zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy project files
COPY . .

# Install Laravel dependencies and build frontend assets
RUN composer install --no-dev --no-scripts --optimize-autoloader --no-interaction --prefer-dist

RUN if [ -f package-lock.json ]; then npm ci; else npm install; fi

RUN npm run build

RUN rm -rf node_modules \
    && mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache storage/logs bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache

# Nginx config and start script
COPY docker/nginx.conf.template /etc/nginx/templates/default.conf.template
COPY docker/start.sh /usr/local/bin/start.sh

RUN chmod +x /usr/local/bin/start.sh

EXPOSE 10000

CMD ["/usr/local/bin/start.sh"]
