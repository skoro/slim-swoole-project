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

declare(strict_types=1);

use Slim\App;
use Swoole\Http\Server as HttpServer;
use Swoole\Runtime;

return function (App $app): HttpServer {
    /**
     * @link https://openswoole.com/docs/modules/swoole-runtime-flags
     */
    Runtime::enableCoroutine(true, SWOOLE_HOOK_ALL);

    $server = new HttpServer(env('SERVER_ADDR', 'localhost'), (int) env('SERVER_PORT', 9501));

    $server->set([
        'worker_num' => env('WORKER_NUM'),
        'pid_file' => VAR_DIR . 'server.pid',
    ]);

    return $server;
};
