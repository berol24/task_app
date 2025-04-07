
FROM php:8.2-fpm

# Installer les dépendances système nécessairesr
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libxml2-dev \
    libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip

# Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Définir le répertoire de travail dans le conteneur
WORKDIR /var/www/html

# Copier les fichiers composer.json et composer.lock dans le conteneur
COPY composer.json composer.lock ./

# Installer les dépendances PHP avec Composer
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Copie tout le reste du code dans le conteneur
COPY . .

#le port sur lequel l'application va tourner 
EXPOSE 80

# Définir la commande pour démarrer PHP-FPM
CMD ["php-fpm"]
