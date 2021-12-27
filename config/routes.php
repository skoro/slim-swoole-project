<?php declare(strict_types=1);

use App\Http\Controllers\GetAllUsersController;
use Slim\App;

return function (App $app) {

    $app->get('/', fn () => json(['status' => 'ok']));

    $app->get('/users', GetAllUsersController::class);
};
