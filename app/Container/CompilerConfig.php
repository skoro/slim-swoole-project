<?php

namespace App\Container;

use WoohooLabs\Zen\Config\AbstractCompilerConfig;

class CompilerConfig extends AbstractCompilerConfig
{

    public function getContainerNamespace(): string
    {
        return "App\\Container";
    }

    public function getContainerClassName(): string
    {
        return "Container";
    }

    public function useConstructorInjection(): bool
    {
        return true;
    }

    public function usePropertyInjection(): bool
    {
        return true;
    }

    public function getContainerConfigs(): array
    {
        return [
            new ContainerConfig(),
        ];
    }
}