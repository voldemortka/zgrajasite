# Pobierz oficjalny obraz PHP z Apache
FROM php:7.4-apache

# Zainstaluj Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Zainstaluj rozszerzenie PostgreSQL
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pgsql pdo_pgsql

# Skopiuj pliki aplikacji do katalogu Apache
COPY . /var/www/html/

# Przejdź do katalogu aplikacji i uruchom Composer, aby zainstalować zależności
WORKDIR /var/www/html/
RUN composer install --no-dev --optimize-autoloader

# Otwórz port 80 (serwer HTTP)
EXPOSE 80
