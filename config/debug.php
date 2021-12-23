<?php

/**
 * This file is used when DEBUG option is enabled.
 * The function `is_debug_enabled()` should be used for such checking.
 *
 * `InotifyWatcher` implies `inotify` pecl extension is installed.
 *
 * The following environment variables affect to this file:
 * - `DEBUG` - enabling this option will process this file.
 * - `FS_WATCH_DELAY` - how often to check source code changes, by default 1000 ms.
 */

use Slim\App;
use Slim\Swoole\FileWatchers\InotifyWatcher;
use Slim\Swoole\HotCodeReloader;
use Swoole\Http\Server;

return function (App $app, Server $server) {

    $watcher = new InotifyWatcher();

    // Directories to be checked for changes.
    // Any changes inside those directories will force to reload the server:
    // - `config`
    // - `app`
    $watcher->addFilePath(__DIR__);
    $watcher->addFilePath(dirname(__DIR__) . '/app');

    $reloader = new HotCodeReloader($watcher, $server, (int) env('FS_WATCH_DELAY', 1000));
    $reloader->start();

};
