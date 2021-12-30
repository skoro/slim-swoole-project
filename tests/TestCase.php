<?php

namespace Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;
use Slim\App;
use Slim\Factory\AppFactory;
use Tests\Support\SendRequest;

class TestCase extends BaseTestCase
{
    use SendRequest;

    protected App $app;

    protected function setUp(): void
    {
        parent::setUp();
        $this->app = $this->getAppInstance();
    }

    private function getAppInstance(): App
    {
        $configDir = dirname(__DIR__) . '/config/';

        AppFactory::setContainer((require $configDir . 'container.php')());
        $app = AppFactory::create();

        (require $configDir . 'middlewares.php')($app);
        (require $configDir . 'routes.php')($app);

        return $app;
    }
}
