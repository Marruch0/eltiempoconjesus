FROM php:8.2.1-fpm
WORKDIR "/app"

# Actualiza paquetes y instala dependencias necesarias
RUN apt-get update && apt-get install -y libzip-dev zip \
    && docker-php-ext-install zip pdo pdo_mysql mysqli \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && pecl install xdebug-3.2.0RC1 && docker-php-ext-enable xdebug \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Copia la configuración personalizada de PHP para usar sesiones en archivos
COPY php.ini /usr/local/etc/php/conf.d/