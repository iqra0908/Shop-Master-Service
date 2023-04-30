# Use the official WordPress image as the base image
FROM wordpress:latest

# Set the working directory to the WordPress root directory
WORKDIR /var/www/html

# Copy the contents of the current directory into the container
COPY . .

# Install any required dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libpq-dev \
    libzip-dev \
    unzip \
    && docker-php-ext-configure gd --with-png-dir=/usr --with-jpeg-dir=/usr \
    && docker-php-ext-install gd mysqli pdo pdo_mysql zip

# Set the permissions for the WordPress files
RUN chown -R www-data:www-data /var/www/html

# Expose port 80 for HTTP traffic
EXPOSE 80

# Start the Apache web server
CMD ["apache2-foreground"]
