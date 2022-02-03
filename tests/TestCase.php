<?php

declare(strict_types=1);

namespace Tests;

use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase as BaseTestCase;
use Slim\App;
use Slim\Factory\AppFactory;
use Tests\Support\SampleLoader;
use Tests\Support\SendRequest;

class TestCase extends BaseTestCase
{
    use SendRequest;
    use SampleLoader;

    protected App $app;

    protected function setUp(): void
    {
        parent::setUp();
        $this->app = $this->getAppInstance();
    }

    private function getAppInstance(): App
    {
        $rootDir = dirname(__DIR__);
        $appDir = $rootDir . '/app/';

        $dotenv = Dotenv::createImmutable($rootDir, ['.env.testing', '.env']);
        $dotenv->safeLoad();

        AppFactory::setContainer((require $appDir . 'container.php')());
        $app = AppFactory::create();

        (require $appDir . 'middlewares.php')($app);
        (require $appDir . 'routes.php')($app);

        return $app;
    }
}
