<?php

/**
 * Swoole server initialization.
 *
 * This file provides a callback for create and setup Swoole Http server.
 * The server events will be attached later in `bin/server.php` file.
 *
 * @used-by ../bin/server.php
 * @link https://openswoole.com/docs/modules/swoole-http-server-doc
 * @link https://openswoole.com/docs/modules/swoole-server/configuration
 */

use Slim\App;
use Swoole\Http\Server as HttpServer;

return function (App $app): HttpServer {

    $server = new HttpServer(env('SERVER_ADDR', 'localhost'), env('SERVER_PORT', 9501));

    $server->set([
        'worker_num' => env('WORKER_NUM'),
        'pid_file' => VAR_DIR . 'server.pid',
    ]);

    return $server;
};
