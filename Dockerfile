
# Use official PHP image with Apache
FROM php:8.2-apache

# Enable Apache rewrite module
RUN a2enmod rewrite

# Copy project files into the Apache server directory
COPY . /var/www/html/

# Set write permissions for uploads folder
RUN chmod -R 777 /var/www/html/uploads
RUN mkdir -p /var/www/html/uploads && chmod -R 777 /var/www/html/uploads

# Expose Apache's default port
EXPOSE 80
