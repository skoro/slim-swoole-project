<?php

use Dotenv\Dotenv;
use Slim\Factory\AppFactory;
use Slim\Swoole\ServerRequestFactory;
use Swoole\Http\Server as HttpServer;

define('ROOT_DIR', dirname(__DIR__));
const CONFIG_DIR = ROOT_DIR . '/config/';
const APP_DIR = ROOT_DIR . '/app/';
const VAR_DIR = ROOT_DIR . '/var/';

require_once ROOT_DIR . '/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(ROOT_DIR);
$dotenv->safeLoad();

AppFactory::setContainer((function () {
    return (require CONFIG_DIR . 'container.php')();
})());

$app = AppFactory::create();

$server = new HttpServer(env('SERVER_ADDR', 'localhost'), env('SERVER_PORT', 9501));
$server->set((function () {
    return include CONFIG_DIR . 'server.php';
})());

$server->on('workerStart', function (HttpServer $server) use ($app) {

    (function ($app) {
        (require CONFIG_DIR . 'middlewares.php')($app);
    })($app);

    (function ($app) {
        (require CONFIG_DIR . 'routes.php')($app);
    })($app);

});

$server->on('request', ServerRequestFactory::createRequestCallback($app));

$server->on('start', function (HttpServer $server) use ($app) {
    if (is_debug_enabled()) {
        (function ($app, $server) {
            // Debug configuration is optional and can be ignored.
            (include CONFIG_DIR . 'debug.php')($app, $server);
        })($app, $server);
    }
});

$server->start();
