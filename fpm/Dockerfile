## assembly based on rc-fpm image  428MB

FROM php:8.1-rc-fpm

# COPY ./conf/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

RUN apt-get update \ 
    && apt-get install -y nano \ 
    && apt-get install -y iputils-ping \ 

    && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo_pgsql \
    && docker-php-ext-enable pdo_pgsql 

RUN apt-get update -y && apt-get install -y sendmail libpng-dev build-essential libssl-dev zlib1g-dev libpng-dev libjpeg-dev libfreetype6-dev

RUN apt-get update && \
    apt-get install -y \
        zlib1g-dev 

RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd


RUN pecl install xdebug \
    && docker-php-ext-enable xdebug 


RUN apt-get -y install cron

RUN touch /usr/local/etc/php/conf.d/docker-php-memlimit.ini
RUN echo 'memory_limit = 512m' >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini
RUN echo 'post_max_size = 25m' >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini
RUN echo 'upload_max_filesize = 25m' >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini

## assembly based on alpine image 654MB

# FROM php:8.0-fpm-alpine3.13

# RUN apk update \
#     && apk add postgresql-dev \ ~ 170MB

#     && docker-php-ext-install pdo_pgsql \
#     && docker-php-ext-configure pdo_pgsql \
#     && docker-php-ext-enable pdo_pgsql

# WORKDIR /var/www/
