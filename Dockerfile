FROM php:8.3-apache

RUN docker-php-ext-install pdo_mysql && docker-php-ext-enable pdo_mysql

RUN a2enmod rewrite

# Update
RUN apt-get -y update --fix-missing && \
    apt-get upgrade -y && \
    apt-get --no-install-recommends install -y apt-utils && \
    rm -rf /var/lib/apt/lists/*

# Install Composer
RUN curl --silent --show-error https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install