<?php

declare(strict_types=1);

use Dotenv\Dotenv;
use Slim\Factory\AppFactory;
use Slim\Swoole\ServerRequestFactory;
use Swoole\Http\Server as HttpServer;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(ROOT_DIR);
$dotenv->safeLoad();

AppFactory::setContainer((function () {
    return (require APP_DIR . 'container.php')();
})());

$app = AppFactory::create();
$server = (require APP_DIR . 'server.php')($app);

$server->on('workerStart', function (HttpServer $server) use ($app) {

    (function ($app) {
        (require APP_DIR . 'middlewares.php')($app);
    })($app);

    (function ($app) {
        (require APP_DIR . 'routes.php')($app);
    })($app);
});

$server->on('request', ServerRequestFactory::createRequestCallback($app));

$server->on('start', function (HttpServer $server) use ($app) {
    if (is_debug_enabled()) {
        (function ($app, $server) {
            // Debug configuration is optional and can be ignored.
            (include APP_DIR . 'debug.php')($app, $server);
        })($app, $server);
    }
    logger($app)->info(sprintf('Server is started on %s:%d', $server->host, $server->port));
});

$server->start();
