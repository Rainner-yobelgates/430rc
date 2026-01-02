# Stage 1: Vendor
FROM ronaregen/php:apache-latest AS vendor
WORKDIR /app


COPY composer.json composer.lock ./

RUN composer install \
    --ignore-platform-reqs \
    --no-ansi \
    --no-dev \
    --no-interaction \
    --no-scripts \
    --no-autoloader


COPY . .
RUN composer dump-autoload --optimize --no-dev

# -----------------------------------------------
# Main stage
FROM ronaregen/php:apache-latest AS main

# Copy config
COPY php.ini /usr/local/etc/php/conf.d/
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
COPY laravel.conf /etc/apache2/sites-available/000-default.conf

# Set Workdir
WORKDIR /var/www/html

# Copy dari stage vendor
# Pastikan folder vendor & app bersih
COPY --chown=www-data:www-data --from=vendor /app /var/www/html

RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 80
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
