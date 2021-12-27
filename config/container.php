<?php declare(strict_types=1);

use App\Container\CompilerConfig;
use App\Container\Container;
use Psr\Container\ContainerInterface;
use WoohooLabs\Zen\RuntimeContainer;

return function (): ContainerInterface {

    if (is_debug_enabled()) {
        return new RuntimeContainer(new CompilerConfig());
    }

    return new Container();
};
