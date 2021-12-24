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

Please keep in mind, changing your project source code won't be
applied automatically, you need to restart the server manually.
To make life easier, you could enable `DEBUG=true` mode in your `.env` and the server
will restart automatically depending on the project source code
changes but this feature requires `inotify` extension to be installed.
Instead of editing your `.env` you could start the server like this:
```bash
DEBUG=true composer run server
```