<?php

use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Swoole\Http\RequestCallback;
use Swoole\Http\Server;

require_once __DIR__ . '/vendor/autoload.php';

$app = AppFactory::create();
$app->addErrorMiddleware(true, false, true);

$app->add(new \App\Http\Middleware\JsonBodyParserMiddleware());

$app->get('/', function (Request $request, Response $response) {
    $response->getBody()->write('output with ' . date('Y-m-d H:i:s'));
    return $response;
});

$app->post('/post', function (Request $request, Response $response) {
    $x = $request->getParsedBody();
    return new JsonResponse([
        'status' => 'ok',
        'value' => $x,
    ]);
});

$server = new Server('localhost', 9501);

$server->on('request', RequestCallback::fromCallable(
    static fn (Request $request): Response => $app->handle($request)
));

$server->start();
