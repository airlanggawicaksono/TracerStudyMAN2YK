# Tracer Study MAN2YK — procedural PHP app (mysqli).
FROM php:8.2-apache

# mysqli is the only extension the app needs (koneksi.php / mysqli_*).
RUN docker-php-ext-install mysqli \
    && a2enmod rewrite

# Source is bind-mounted in docker-compose.yml (instant edits, no rebuild),
# so no COPY here. Apache serves /var/www/html with index.php as the index.
WORKDIR /var/www/html
EXPOSE 80
