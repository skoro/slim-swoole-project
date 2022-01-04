<?php declare(strict_types=1);

namespace Tests;

use Dotenv\Dotenv;
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
        $rootDir = dirname(__DIR__);
        $configDir = $rootDir . '/config/';

        $dotenv = Dotenv::createImmutable($rootDir, ['.env.testing', '.env']);
        $dotenv->safeLoad();

        AppFactory::setContainer((require $configDir . 'container.php')());
        $app = AppFactory::create();

        (require $configDir . 'middlewares.php')($app);
        (require $configDir . 'routes.php')($app);

        return $app;
    }
}
