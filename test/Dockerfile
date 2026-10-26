# A throwaway Flarum 1.8 forum for testing the extension. Not shipped.
FROM php:8.2.34-apache-bookworm
RUN apt-get update \
 && apt-get install -y --no-install-recommends libpng-dev libjpeg-dev libfreetype6-dev libzip-dev libicu-dev unzip git \
 && docker-php-ext-configure gd --with-freetype --with-jpeg \
 && docker-php-ext-install -j"$(nproc)" gd pdo_mysql zip intl exif \
 && a2enmod rewrite \
 && rm -rf /var/lib/apt/lists/*
COPY --from=composer:2.10.2 /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER=1
WORKDIR /var/www/flarum
# Flarum 1.8 still uses league/flysystem 1, which has security advisories, and
# Composer 2.9 and later refuse to install it unless told to.
RUN composer config --global policy.advisories.block false \
 && composer create-project flarum/flarum:v1.8.19 . --no-interaction --no-dev \
 && sed -ri 's!/var/www/html!/var/www/flarum/public!g' /etc/apache2/sites-available/000-default.conf \
 && printf '<Directory /var/www/flarum/public>\n  AllowOverride All\n</Directory>\n' > /etc/apache2/conf-enabled/flarum.conf \
 && composer config --global --unset policy.advisories.block
COPY entrypoint.sh /entrypoint.sh
CMD ["/entrypoint.sh"]
