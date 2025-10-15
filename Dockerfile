# Usando imagem oficial PHP com Apache
FROM php:8.4-apache

# Instala dependências do sistema e extensões do PHP
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    git \
    curl \
    libonig-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip fileinfo

# Habilita mod_rewrite do Apache
RUN a2enmod rewrite

# Instala o Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copia o código do projeto para o container
COPY . /var/www/html

# Define permissões
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Aponta o DocumentRoot para a pasta public do Laravel
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# Permite que o Apache leia o .htaccess
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Copia o script run.sh
COPY run.sh /usr/local/bin/run.sh
RUN chmod +x /usr/local/bin/run.sh

# Define diretório de trabalho
WORKDIR /var/www/html

# Expõe a porta 80
EXPOSE 80

# Define o entrypoint para executar o script
ENTRYPOINT ["/usr/local/bin/run.sh"]
