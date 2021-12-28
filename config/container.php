<?php declare(strict_types=1);

use App\Repositories\ArrayUserRepository;
use App\Repositories\UserRepository;
use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;
use function DI\create;

/**
 * Gets the PSR-11 compatible DI container.
 */
return function (): ContainerInterface {

    $builder = new ContainerBuilder();

    $builder->addDefinitions([
        UserRepository::class => create(ArrayUserRepository::class),
    ]);

    $builder->addDefinitions([
        \Psr\Log\LoggerInterface::class => function (ContainerInterface $c) {
            $logger = new \Monolog\Logger(env('APP_NAME', 'slim-swoole'));
            $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
            $logger->pushHandler(new \Monolog\Handler\StreamHandler('php://stdout'));
            return $logger;
        },
    ]);

    return $builder->build();
};
