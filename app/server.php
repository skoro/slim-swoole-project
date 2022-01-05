<?php

/**
 * Swoole server configuration.
 *
 * @link https://openswoole.com/docs/modules/swoole-server/configuration
 */

return [
    'worker_num' => env('WORKER_NUM'),
    'pid_file' => VAR_DIR . 'server.pid',
];
