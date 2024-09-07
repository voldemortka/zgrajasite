# Pobierz oficjalny obraz PHP z Apache
FROM php:7.4-apache

# Skopiuj pliki aplikacji do katalogu Apache
COPY . /var/www/html/

# Otwórz port 80 (serwer HTTP)
EXPOSE 80
