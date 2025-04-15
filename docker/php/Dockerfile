# Imagen PHP sin incluir Apache, sin necesidad de un servidor web
FROM php:8.2-cli 

# Instala dependencias
RUN apt-get update && apt-get install -y \
    zip unzip git curl \
    && docker-php-ext-install pdo pdo_mysql

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer