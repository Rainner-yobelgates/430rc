FROM php:8.3-apache

# Update dan install sekaligus bersihkan cache di akhir
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    libpq-dev \
    libonig-dev \
    libicu-dev \
    libxml2-dev \
    libtidy-dev \
    bash curl zip unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    gd pdo pdo_pgsql mbstring zip bcmath intl \
    mysqli pdo_mysql exif soap opcache tidy \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN a2enmod rewrite

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy composer files dulu biar layer cache-nya kepake
COPY composer.json composer.lock ./
RUN composer install \
    --ignore-platform-reqs \
    --no-ansi \
    --no-dev \
    --no-interaction \
    --no-scripts --no-autoloader

# Baru copy sisa filenya
COPY --chown=www-data:www-data . /var/www/html
RUN composer dump-autoload --optimize

COPY php.ini /usr/local/etc/php/conf.d/
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
COPY laravel.conf /etc/apache2/sites-available/000-default.conf

RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 80
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
