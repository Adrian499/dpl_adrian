# Imagen base Debian
FROM debian:stable

# Mantenedor
MAINTAINER adrian25 1.0

# Actualizamos e instalamos dependencias
RUN apt update && apt install -y apt-utils curl gnupg2 ca-certificates lsb-release

# Añadimos el repositorio oficial de PHP 8.4
RUN curl -sSL https://packages.sury.org/php/README.txt | grep -q sury \
    && echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | tee /etc/apt/sources.list.d/php.list \
    && curl -fsSL https://packages.sury.org/php/apt.gpg | gpg --dearmor -o /etc/apt/trusted.gpg.d/php.gpg

# Instalamos nginx y PHP 8.4 con FPM
RUN apt update && apt install -y nginx php8.4 php8.4-fpm

# Creamos el directorio del usuario y copiamos el archivo PHP
RUN mkdir -p /usr/dpl_adri/calc-docker
COPY index.php /usr/dpl_adri/calc-docker/index.php
RUN chmod 644 /usr/dpl_adri/calc-docker/index.php

# Configuramos Nginx para servir PHP
RUN rm /etc/nginx/sites-enabled/default
RUN echo 'server {\n\
    listen 80;\n\
    root /usr/dpl_adri/calc-docker;\n\
    index index.php index.html;\n\
    server_name localhost;\n\
\n\
    location / {\n\
        try_files $uri $uri/ =404;\n\
    }\n\
\n\
    location ~ \.php$ {\n\
        include snippets/fastcgi-php.conf;\n\
        fastcgi_pass unix:/run/php/php8.4-fpm.sock;\n\
    }\n\
\n\
    location ~ /\.ht {\n\
        deny all;\n\
    }\n\
}' > /etc/nginx/sites-enabled/default

# Exponemos el puerto 80
EXPOSE 80

# Comando para ejecutar PHP-FPM y Nginx juntos
CMD service php8.4-fpm start && nginx -g 'daemon off;'

