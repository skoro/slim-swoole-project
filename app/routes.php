<?php declare(strict_types=1);

use Slim\App;

return function (App $app) {

    $app->get('/', fn () => json(['status' => 'ok']));

};
