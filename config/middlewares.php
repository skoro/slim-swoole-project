<?php declare(strict_types=1);

use Slim\App;

return function (App $app) {

    if (is_debug_enabled()) {
        $app->addErrorMiddleware(displayErrorDetails: true, logErrors: true, logErrorDetails: true);
    } else {
        $app->addErrorMiddleware(displayErrorDetails: false, logErrors: false, logErrorDetails: false);
    }

    // Enable if you need to parse json requests
    // or add your own.
//     $app->addBodyParsingMiddleware();

    // Put your global middlewares here...

};
