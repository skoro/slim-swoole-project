<?php

use Dotenv\Dotenv;
use Slim\Factory\AppFactory;
use Slim\Swoole\ServerRequestFactory;
use Swoole\Http\Server as HttpServer;

const ROOT_DIR = __DIR__;
const CONFIG_DIR = ROOT_DIR . '/config/';
const APP_DIR = ROOT_DIR . '/app/';
const VAR_DIR = ROOT_DIR . '/var/';

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(ROOT_DIR);
$dotenv->safeLoad();

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

$server->start();
