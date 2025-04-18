# Usa la imagen oficial de PHP 8.2 con FPM (FastCGI Process Manager)
FROM php:8.2-fpm

# ======================
# Instalación de dependencias del sistema
# ======================
# Actualiza el índice de paquetes e instala utilidades necesarias
# zip/unzip para empaquetado, curl para descargas
RUN apt-get update && apt-get install -y \
    curl \
    unzip \
    nginx \
    && rm -rf /var/lib/apt/lists/*

# ======================
# Instalación de Composer
# ======================
# Copia el ejecutable de Composer desde una imagen oficial ya preparada (más rápido que descargarlo a mano)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# ======================
# Instalación de PHPUnit
# ======================
# Descarga el archivo .phar de PHPUnit
# Da permisos de ejecución al binario
RUN curl -sS https://phar.phpunit.de/phpunit-9.phar --output /usr/local/bin/phpunit && \  
    chmod +x /usr/local/bin/phpunit  

# ======================
# Copia los archivos del proyecto
# ======================
# Copia los archivos de la aplicación al contenedor
COPY . /var/www/

# ======================
# Configuración de NGINX
# ======================
# Copia el archivo de configuración de NGINX al contenedor
COPY ./docker/ngnix/default.conf /etc/nginx/sites-available/default

# ======================
# Exponer el puerto 80
# ======================
EXPOSE 80

# ======================
# Comando por defecto al iniciar el contenedor
# ======================
# Inicializa NGINX y PHP-FPM al mismo tiempo
CMD service nginx start && php-fpm
