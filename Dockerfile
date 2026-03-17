# College Management System Docker Setup

FROM node:20-alpine AS frontend-build

# Build frontend
WORKDIR /app/frontend
COPY frontend/package*.json ./
RUN npm ci
COPY frontend/ ./
RUN npm run build

# PHP Apache Runtime
FROM php:8.2-apache

# Install required PHP extensions and tools
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd zip pdo pdo_mysql mysqli \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy backend files
COPY backend/ /var/www/html/backend/

# Copy frontend build from previous stage
COPY --from=frontend-build /app/frontend/dist/ /var/www/html/

# Copy other necessary directories
COPY upload/ /var/www/html/upload/
COPY assignment/ /var/www/html/assignment/

# Configure Apache virtual host
COPY docker/apache.conf /etc/apache2/sites-available/000-default.conf

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Create upload directories if they don't exist
RUN mkdir -p /var/www/html/upload /var/www/html/assignment \
    && chown -R www-data:www-data /var/www/html/upload /var/www/html/assignment \
    && chmod -R 755 /var/www/html/upload /var/www/html/assignment

EXPOSE 80

CMD ["apache2-foreground"]
