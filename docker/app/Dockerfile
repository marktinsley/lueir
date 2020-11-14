FROM php:7.4-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

RUN pecl install redis \
    && pecl install xdebug \
    && docker-php-ext-enable redis xdebug

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN addgroup --gid 1024 devgroup
RUN adduser --disabled-password --gecos "" --force-badname --ingroup devgroup devuser
USER devuser

RUN alias a="php artisan"

# Set working directory
WORKDIR /app
