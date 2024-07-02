FROM php:8.3-fpm-bullseye
WORKDIR "/application"

COPY php-ini-overrides.ini /etc/php/8.1/fpm/conf.d/99-overrides.ini
COPY . /application

RUN mkdir -p /application/var/cache
RUN mkdir -p /application/var/log
RUN mkdir -p /application/public/media

RUN chmod -R 777 /application/var/cache
RUN chmod -R 777 /application/var/log
RUN chmod -R 777 /application/public/media

RUN apt-get update && apt-get install -y \
        libcurl4-openssl-dev \
        libxml2-dev \
        pkg-config \
        curl \
        libzip-dev \
        libicu-dev \
        zlib1g-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd curl bcmath zip intl mysqli;

#RUN apt-get update; \
#    apt-get -y --no-install-recommends install \
#        git \
#        php8.1-bcmath \
#        php8.1-bz2 \
#        php8.1-gd \
#        php8.1-imagick \
#        php8.1-intl \
#        php8.1-mcrypt \
#        php8.1-mysql \
#        php8.1-redis \
#        php8.1-yaml; \

RUN apt-get clean; \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*; \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer;



