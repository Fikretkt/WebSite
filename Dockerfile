# Resmi PHP 8.2 ve Apache imajını kullan
FROM php:8.2-apache

# Veritabanı bağlantısı için gerekli sürücüleri kur
RUN docker-php-ext-install pdo pdo_mysql mysqli

# URL yönlendirmeleri (Router) için mod_rewrite'ı aç
RUN a2enmod rewrite

# Çalışma dizinini belirle
WORKDIR /var/www/html

# Apache'nin kök dizinini 'public' klasörüne yönlendir (ÖNEMLİ!)
# Normalde /var/www/html'dir ama biz MVC yapısı kullandığımız için /public olmalı.
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Apache ayar dosyalarını güncelle
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Proje dosyalarını konteyner içine kopyala
COPY . /var/www/html/

# Dosya izinlerini Apache kullanıcısına ver
RUN chown -R www-data:www-data /var/www/html