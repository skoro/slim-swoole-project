<?php declare(strict_types=1);

use Slim\App;

return function (App $app) {

    // TODO: debug mode.
    $app->addErrorMiddleware(displayErrorDetails: false, logErrors: false, logErrorDetails: false);

    // Put your global middlewares here...

//    $app->add(new \App\Http\Middleware\JsonBodyParserMiddleware());
};
