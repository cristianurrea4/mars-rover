# Usa la imagen oficial de PHP 8.2 con FPM (FastCGI Process Manager)
FROM php:8.2-fpm

# ======================
# Instalación de dependencias del sistema
# ======================
# Actualiza el índice de paquetes e instala utilidades necesarias
# zip/unzip para empaquetado, curl para descargas

    RUN apt-get update && apt-get install -y \
    curl \
    unzip

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
# Comando por defecto al iniciar el contenedor
# ======================
# Ejecuta php-fpm cuando el contenedor se inicie
CMD ["php-fpm"]
