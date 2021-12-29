<?php declare(strict_types=1);

use Slim\App;

return function (App $app) {

    $app->addErrorMiddleware(
        displayErrorDetails: is_debug_enabled(),
        logErrors: (bool) env('LOG_ERRORS', false),
        logErrorDetails: (bool) env('LOG_ERROR_DETAILS', false),
        logger: logger($app),
    );

    // Enable if you need to parse json requests
    // or add your own.
//     $app->addBodyParsingMiddleware();

    // Put your global middlewares here...

};
