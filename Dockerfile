FROM php:8.1-apache

# Copie tous les fichiers dans le dossier web d’Apache
COPY . /var/www/html/

# Ouvre le port 80
EXPOSE 80
