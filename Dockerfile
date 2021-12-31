FROM phpswoole/swoole:4.8-php8.0

COPY . /var/www

RUN composer install

