# Используем базовый образ с PHP и Apache
FROM php:7.4-apache

# Устанавливаем SQLite3
RUN apt-get update && apt-get install -y sqlite3 libsqlite3-dev

# Включаем модуль Apache для PHP
RUN docker-php-ext-install pdo_sqlite

# Копируем файлы приложения в директорию /var/www/html
COPY . /var/www/html

# Устанавливаем права доступа
RUN chown -R www-data:www-data /var/www/html

# Открываем порт 80
EXPOSE 80
