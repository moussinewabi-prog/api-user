# Utiliser une image officielle PHP avec Apache
FROM php:8.2-apache

# Copier les fichiers du projet dans le dossier web d’Apache
COPY . /var/www/html/

# Installer les extensions PHP nécessaires
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Donner les bons droits
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Exposer le port 80 (port HTTP par défaut)
EXPOSE 80
