# Usar a imagem oficial do PHP com Apache
FROM php:7.4-apache

# Copiar arquivos do projeto para o diretório padrão do Apache
COPY src/ /var/www/html/

# Habilitar extensões PHP necessárias
RUN docker-php-ext-install pdo pdo_mysql

# Expor a porta 80 para acesso ao Apache
EXPOSE 80
