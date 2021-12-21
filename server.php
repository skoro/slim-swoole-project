<?php

use Dotenv\Dotenv;
use Slim\Factory\AppFactory;
use Slim\Swoole\ServerRequestFactory;
use Swoole\Http\Server as HttpServer;

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$app = AppFactory::create();

$server = new HttpServer(env('SERVER_ADDR', 'localhost'), env('SERVER_PORT', 9501));

$server->on('workerStart', function (HttpServer $server) use ($app) {

    (function ($app) {
        (require __DIR__ . '/config/middlewares.php')($app);
    })($app);

    (function ($app) {
        (require __DIR__ . '/config/routes.php')($app);
    })($app);

});

$server->on('request', ServerRequestFactory::createRequestCallback($app));

$server->start();
