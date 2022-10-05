FROM phpswoole/swoole:4.8-php8.1

RUN set -ex \
    && apt update && apt upgrade --yes \
    && apt install --yes libzip-dev \
    && docker-php-ext-install -j$(nproc) opcache pdo_mysql zip \
    && pecl update-channels \
	&& pecl install inotify \
    && docker-php-ext-enable inotify \
    && apt clean && rm -rf /var/lib/apt/lists && rm -rf /tmp/pear

RUN composer selfupdate

# remove server demo from swoole image
RUN rm /var/www/server.php

COPY ../.. /var/www

WORKDIR /var/www
