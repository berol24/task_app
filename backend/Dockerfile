# Utiliser l'image PHP avec Composer intégré
FROM php:8.2-fpm

# Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Installer les extensions PHP nécessaires
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip \
    && docker-php-ext-install pdo_mysql zip

# Copier le projet dans le container
WORKDIR /app
COPY . .

# Installer les dépendances avec Composer
RUN composer install --no-dev --optimize-autoloader

# Exposer le port 80 pour le serveur Symfony
EXPOSE 80

# Commande par défaut pour lancer le serveur Symfony
CMD ["php", "-S", "0.0.0.0:80", "-t", "public"]
