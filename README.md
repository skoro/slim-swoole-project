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

## Dependency Injection

This project uses [Zen](https://github.com/woohoolabs/zen) DI container
as pretty fast and simple for configuring. But it's up to you which
container to use. If you want to use your own container you have to
return the container instance in `config/container.php` function.
Keep in mind, a container must be compatible with `psr-11`, this is
a requirement of Slim framework.

If you want to continue with Zen, please read the [documentation](https://github.com/woohoolabs/zen/blob/master/README.md).
Since Zen is a compiled based container you have to manually build
the container if you are not using the debug mode `DEBUG=false`
otherwise `RuntimeContainer` will be used.
For building, you could use the following command:
```bash
$ composer run build-container
```

The dependencies are declared in `app\Container\ContainerConfig` class.
In the provided class, there is injection for route controllers. 