# Dockerfile

FROM php:8.2-fpm

# Installer les dépendances système
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip unzip git curl \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copier les fichiers du projet Laravel
COPY . /var/www
WORKDIR /var/www

# Donner les permissions au dossier
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage /var/www/bootstrap/cache

# Exposer le port FastCGI (9000)
EXPOSE 9000

# Lancer PHP-FPM (FastCGI)
CMD ["php-fpm"]
