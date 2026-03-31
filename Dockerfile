FROM php:8.2-apache

# Activer les modules Apache nécessaires
RUN a2enmod rewrite

# Installer les extensions PHP nécessaires
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zlib1g-dev \
    libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    gd \
    mysqli \
    pdo \
    pdo_mysql \
    zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Copier les fichiers du projet dans le conteneur
COPY . /var/www/html/

# Définir le propriétaire et les permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Configurer Apache pour le répertoire racine
RUN sed -i 's|/var/www/html|/var/www/html|g' /etc/apache2/sites-available/000-default.conf

# Exposer le port HTTP
EXPOSE 80

# Démarrer Apache
CMD ["apache2-foreground"]
