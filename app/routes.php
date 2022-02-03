<?php

/**
 * Application routes list.
 *
 * @link https://www.slimframework.com/docs/v4/objects/routing.html
 */

declare(strict_types=1);

use Slim\App;

return function (App $app): void {

    $app->get('/', fn () => json(['status' => 'ok']));
};
