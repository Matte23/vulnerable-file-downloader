FROM php:8.4-fpm

# Install necessary extensions
RUN docker-php-ext-install pdo pdo_mysql

# Set the working directory
WORKDIR /var/www/html

# Copy the PHP source code
COPY src/ .

# Expose the port the app runs on
EXPOSE 80

# Start the PHP-FPM server
CMD ["php-fpm"]