<?php

use Dotenv\Dotenv;
use Slim\Factory\AppFactory;
use Slim\Swoole\ServerRequestFactory;
use Swoole\Http\Server as HttpServer;

define('ROOT_DIR', dirname(__DIR__));
const APP_DIR = ROOT_DIR . '/app/';
const SRC_DIR = ROOT_DIR . '/src/';
const VAR_DIR = ROOT_DIR . '/var/';

require_once ROOT_DIR . '/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(ROOT_DIR);
$dotenv->safeLoad();

AppFactory::setContainer((function () {
    return (require APP_DIR . 'container.php')();
})());

$app = AppFactory::create();

$server = new HttpServer(env('SERVER_ADDR', 'localhost'), env('SERVER_PORT', 9501));
$server->set((function () {
    return include APP_DIR . 'server.php';
})());

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
    logger($app)->info('Server is started.');
});

$server->start();
