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

# Étape 3 : Installer Composer depuis l’image officielle
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Étape 4 : Copier les fichiers de l'application dans le conteneur
WORKDIR /var/www# Étape 1 : Utiliser une image officielle PHP avec FPM
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

# Étape 3 : Installer Composer depuis l’image officielle
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Étape 4 : Copier les fichiers de l'application dans le conteneur
WORKDIR /var/www
COPY . .
RUN chmod -R 755 /var/www

# Étape 5 : Installer les dépendances PHP via Composer
RUN composer install --no-dev --prefer-dist --optimize-autoloader --no-scripts

# Étape 6 : Donner les permissions
RUN chown -R www-data:www-data /var/www

# Exposer le port (utilisé par php-fpm)
EXPOSE 9000

# Commande de démarrage
CMD ["php-fpm"]

# Configuration de la zone horaire
ENV TZ=Europe/Paris
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# Configuration des variables d'environnement
ENV COMPOSER_HOME=app/composer
ENV COMPOSER_CACHE_DIR=app/composer/cache
ENV COMPOSER_VENDOR_DIR=app/vendor
ENV APP_ENV=prod
ENV APP_DEBUG=0
ENV APP_KEY=base64:your_app_key_here
ENV APP_URL=http://localhost
ENV LOG_CHANNEL=stack
ENV LOG_LEVEL=debug
ENV DB_CONNECTION=mysql
ENV DB_HOST=127.0.0.1
ENV DB_PORT=3306
ENV DB_DATABASE=your_database_name_here
ENV DB_USERNAME=your_database_username_here
ENV DB_PASSWORD=your_database_password_here
ENV BROADCAST_DRIVER=log
ENV CACHE_DRIVER=file
ENV QUEUE_CONNECTION=sync
ENV SESSION_DRIVER=file
ENV SESSION_LIFETIME=120
ENV REDIS_HOST=127.0.0.1
ENV REDIS_PASSWORD=null
ENV REDIS_PORT=6379
ENV MAIL_MAILER=smtp
ENV MAIL_HOST=smtp.mailtrap.io
ENV MAIL_PORT=2525
ENV MAIL_USERNAME=null
ENV MAIL_PASSWORD=null
ENV MAIL_ENCRYPTION=null
ENV MAIL_FROM_ADDRESS=null
ENV MAIL_FROM_NAME="${APP_NAME}"
COPY . .

# Étape 5 : Installer les dépendances PHP via Composer
RUN composer install

# Étape 6 : Donner les permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www

# Exposer le port (utilisé par php-fpm)
EXPOSE 9000

# Commande de démarrage
CMD ["php-fpm"]
