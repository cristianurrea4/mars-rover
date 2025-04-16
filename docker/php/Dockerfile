FROM php:8.2-fpm 

# Instala dependencias
RUN apt-get update && apt-get install -y \
    zip unzip git curl \
    && docker-php-ext-install pdo pdo_mysql

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Asegúrate de que php-fpm se ejecute correctamente por defecto
CMD ["php-fpm"]
