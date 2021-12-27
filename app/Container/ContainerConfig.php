<?php

namespace App\Container;

use App\Repositories\ArrayUserRepository;
use App\Repositories\UserRepository;
use WoohooLabs\Zen\Config\AbstractContainerConfig;
use WoohooLabs\Zen\Config\EntryPoint\EntryPointInterface;
use WoohooLabs\Zen\Config\EntryPoint\WildcardEntryPoint;
use WoohooLabs\Zen\Config\Hint\DefinitionHintInterface;
use WoohooLabs\Zen\Config\Hint\WildcardHintInterface;

class ContainerConfig extends AbstractContainerConfig
{

    protected function getEntryPoints(): array
    {
        return [
            new WildcardEntryPoint(dirname(__DIR__) . '/Http/Controllers'),
        ];
    }

    protected function getDefinitionHints(): array
    {
        return [
            UserRepository::class => ArrayUserRepository::class,
        ];
    }

    protected function getWildcardHints(): array
    {
        return [

        ];
    }
}