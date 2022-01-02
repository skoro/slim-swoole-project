FROM phpswoole/swoole:4.8-php8.0

COPY . /var/www

RUN pecl update-channels \
	&& pecl install inotify \
	&& docker-php-ext-install opcache \
	&& docker-php-ext-enable inotify

RUN composer selfupdate
