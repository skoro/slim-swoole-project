<?php

declare(strict_types=1);

use Slim\App;

return function (App $app): void {

    $app->get('/', fn () => json(['status' => 'ok']));
};
