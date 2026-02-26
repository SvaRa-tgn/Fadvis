FROM php:8.2-fpm

WORKDIR /app

RUN export CFLAGS="$PHP_CFLAGS" CPPFLAGS="$PHP_CPPFLAGS" LDFLAGS="$PHP_LDFLAGS" \
    && apt-get update \
    && apt-get install -y --no-install-recommends \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng-dev \
        libicu-dev \
        libpq-dev \
        libxpm-dev \
        libvpx-dev \
        libgmp-dev \
        libmagickwand-dev \
        libzip-dev \
        libcurl4-openssl-dev \
        libmagic-dev \
        libevent-dev \
        libidn2-0-dev \
        libidn11-dev \
        zlib1g-dev \
        unzip \
        git \
    && rm -rf /var/lib/apt/lists/* \
    && ln -s /usr/include/x86_64-linux-gnu/gmp.h /usr/local/include/

# Установка PHP расширений через PECL
RUN pecl install imagick-3.7.0 && \
    docker-php-ext-enable imagick

# Настройка и установка встроенных расширений
RUN docker-php-ext-configure gmp && \
    docker-php-ext-install gmp bcmath zip intl pgsql pdo_pgsql exif && \
    docker-php-ext-configure gd --with-freetype=/usr/include/freetype2 --with-jpeg=/usr/include && \
    docker-php-ext-install -j$(nproc) gd

# Удаляем установку pecl_http - ОН НЕ НУЖЕН!
# Вместо этого будем игнорировать требование ext-http в Composer

# Остальные команды
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
     && php composer-setup.php --install-dir=/usr/bin --filename=composer \
     && php -r "unlink('composer-setup.php');"

ADD cronjobs /etc/cron.d/cronjobs
RUN ls /etc/cron.d/

ADD php.ini /usr/local/etc/php/

RUN apt-get update && apt-get install -y cron && \
    chmod 0644 /etc/cron.d/cronjobs && \
    crontab /etc/cron.d/cronjobs && \
    touch /var/log/cron.log

RUN pecl install xdebug && \
    docker-php-ext-enable xdebug
