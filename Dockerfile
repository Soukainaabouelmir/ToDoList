# Étape 1 : Utiliser une image officielle PHP avec FPM
FROM php:8.2-fpm

# Étape 2 : Installer les dépendances système nécessaires
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    zip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Étape 3 : Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Étape 4 : Configuration du répertoire de travail
WORKDIR /var/www

# Étape 5 : Copier les fichiers de l'application
COPY . .

# Étape 6 : Supprimer les providers invalides (ex: Sail) dans config/app.php avant cette étape !

# Étape 7 : Installer les dépendances via Composer
RUN composer install --no-dev --prefer-dist --optimize-autoloader --no-scripts

# Étape 8 : Donner les permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www

# Étape 9 : Configuration de la timezone
ENV TZ=Europe/Paris
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# Étape 10 : Variables d’environnement Laravel
ENV APP_ENV=prod
ENV APP_DEBUG=0
ENV APP_KEY=base64:wG9NlVFpvAHAbz9eyf9QctV575EsQr27ryA8/GY04yI=
ENV APP_URL=http://localhost
ENV DB_CONNECTION=mysql
ENV DB_HOST=127.0.0.1
ENV DB_PORT=3306
ENV DB_DATABASE=todo_list
ENV DB_USERNAME=root
ENV DB_PASSWORD=

# Étape 11 : Exposer le port FPM
EXPOSE 9000

# Étape 12 : Commande de démarrage
CMD ["php-fpm"]
