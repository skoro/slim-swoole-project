FROM phpswoole/swoole:4.8-php8.0

COPY . /var/www

RUN pecl update-channels \
	&& pecl install inotify \
	&& docker-php-ext-install opcache

RUN composer install

