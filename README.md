# UberCMS

UberCMS for Oblivion by pvictorlv.

---

# UberCMS Docker Deployment Guide

This guide will walk you through the process of setting up and running UberCMS using Docker. The project is structured as follows:

```
ROOT
-|docker-compose.yml
-|.env
-|UberCMS (Folder containing this repository)
---|Dockerfile
```

## Files Explained

### docker-compose.yml

The `docker-compose.yml` file is a YAML file defining services, networks, and volumes. This specific configuration includes three services: cms, mariadb, and phpmyadmin.

```yml
version: '3'

services:
  # UberCMS service configuration
  cms:
    build: 
      context: .
      dockerfile: ./UberCms/Dockerfile
    volumes:
      - ./UberCms:/var/www/html/
    ports:
      - "${CMS_PORT}:80"
    networks:
      - habbo-network
  
  # MariaDB database service configuration
  mariadb:
    image: mariadb:10.5.8
    restart: always
    environment:
      MYSQL_ROOT_PASSWORD: ${MYSQL_ROOT_PASSWORD}
      MYSQL_DATABASE: ${MYSQL_DATABASE}
      MYSQL_USER: ${MYSQL_USER}
      MYSQL_PASSWORD: ${MYSQL_PASSWORD}
    volumes:
      - mariadb-volume:/var/lib/mysql
    ports:
      - "${MYSQL_PORT}:3306"
    networks:
      - habbo-network

  # phpMyAdmin service configuration
  phpmyadmin:
    image: phpmyadmin/phpmyadmin
    ports:
      - "${PHPMYADMIN_HOST}:${PHPMYADMIN_PORT}:80"
    environment:
      PMA_HOST: mariadb
      UPLOAD_LIMIT: ${PHPMYADMIN_UPLOAD_SIZE}
    networks:
      - habbo-network

volumes:
  mariadb-volume:

networks:
  habbo-network:
    driver: bridge
```

### .env

The `.env` file contains environment variables for the CMS, MySQL database, and phpMyAdmin configurations.

```
# CMS Configuration Variables 
CMS_PORT = 8080

# MySQL Configuration Variables 
MYSQL_ROOT_PASSWORD = JHeRjrfhDZjqyMy3eEsghfd
MYSQL_USER = oblivion
MYSQL_PASSWORD = UCgGSxWvqB8NRdFW
MYSQL_DATABASE = oblivion
MYSQL_PORT = 3306

# phpMyAdmin Configuration Variables 
PHPMYADMIN_HOST = 127.0.0.1 
PHPMYADMIN_PORT = 8081 
PHPMYADMIN_UPLOAD_SIZE = 10G 
```

### UberCMS/Dockerfile

The `Dockerfile` in the UberCMS directory specifies how to build the Docker image for our application.

```dockerfile
# Base image
FROM php:8.0-apache

# Update packages
RUN apt-get update

# Upgrade packages
RUN apt-get upgrade -y

# Install required packages
RUN apt-get install -y \
    git \
    zip \
    unzip \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libicu-dev \
    libxml2-dev \
    libcurl4-openssl-dev \
    libxslt-dev \
    libzip-dev \
    libgmp-dev

# Clear out the local repository of retrieved package files
RUN apt-get clean

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mysqli
RUN docker-php-ext-enable mysqli

RUN docker-php-ext-install -j$(nproc) iconv

RUN docker-php-ext-configure gd --with-jpeg=/usr/include/
RUN docker-php-ext-install -j$(nproc) gd
RUN docker-php-ext-enable gd

RUN docker-php-ext-install intl xml curl soap xsl bcmath opcache sockets exif gettext pcntl shmop sysvmsg sysvsem sysvshm gmp zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Enable Apache modules
RUN a2enmod rewrite 

# Set working directory to /var/www/html
WORKDIR /var/www/html

# Expose port 80 for Apache
EXPOSE 80

# Start Apache service in the foreground
CMD ["apache2-foreground"]
```

## Running the Project

To run this project, follow these steps:

1. Install Docker and Docker Compose on your machine.
2. Clone the repository and navigate to the root directory.
3. Run `docker-compose up` command to start all services.
4. Seed your database.
5. Access the application.

Remember to update your `.env` file.

That's it! You should now have UberCMS running on your local machine using Docker. Enjoy!
