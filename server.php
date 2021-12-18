<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Swoole\Http\RequestCallback;
use Swoole\Http\Server as HttpServer;

require_once __DIR__ . '/vendor/autoload.php';

$app = AppFactory::create();

(function ($app) {
    (require __DIR__ . '/config/middlewares.php')($app);
})($app);

(function ($app) {
    (require __DIR__ . '/config/routes.php')($app);
})($app);

$server = new HttpServer('localhost', 9501);

$server->on('request', RequestCallback::fromCallable(
    static fn (Request $request): Response => $app->handle($request)
));

$server->start();
