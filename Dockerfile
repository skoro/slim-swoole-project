FROM phpswoole/swoole:4.8-php8.0

RUN pecl update-channels \
	&& pecl install inotify \
	&& docker-php-ext-install opcache \
	&& docker-php-ext-enable inotify

RUN composer selfupdate

# remove server demo from swoole image
RUN rm /var/www/server.php

COPY . /var/www

WORKDIR /var/www

EXPOSE 9501
