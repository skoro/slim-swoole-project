# Slim Framework + Swoole

A project boilerplate of [Slim Framework](http://slimframework.com/)
and [Swoole](https://github.com/swoole/swoole-src) an event-based asynchronous PHP extension.

## Requirements

* PHP 8
* `swoole` extension
* `inotify` extension (optional but see below)

## Getting Started

Start your new project with composer:

```bash
$ composer create-project skoro/slim-swoole-project <project-path>
```

After installing `cd <project-path>` to project directory.

### Configuring

The default settings are good enough but if you need to customize them
you have to start with copying stock settings:
```bash
$ cp .env.example .env
```

### Starting the server

Then you can start the http server by running this command:
```bash
$ composer run server
```

It will listen to `localhost` and `9501` port if you left
`SERVER_ADDR` and `SERVER_PORT` environment variables by default.

When you need to stop or restart the server by an external command
like `kill` you also can use a pid file which is located in `var/server.pid` directory.

### Debug

Please keep in mind, changing your project source code won't be
applied automatically, you need to restart the server manually.
To make life easier, you could enable `DEBUG=true` mode in your `.env` and the server
will restart automatically depending on the project source code
changes but this feature requires `inotify` extension to be installed.
Instead of editing your `.env` you could start the server like this:
```bash
$ composer run server-debug
```

You should also pay an attention [xdebug](http://xdebug.org/) is not compatible
with Swoole (https://openswoole.com/docs/get-started/common-install-errors#trying-to-use-xdebug-and-swoole).

## Dependency Injection

This project uses [PHP-DI](https://php-di.org/) container implementation.
The container itself and its dependencies are configured in `config/container.php`
file. Keep in mind, you can use any [psr-11](https://www.php-fig.org/psr/psr-11/)
compatible container, so it's up to you which container to use.
