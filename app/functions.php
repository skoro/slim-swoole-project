<?php declare(strict_types=1);

use Laminas\Diactoros\Response\JsonResponse;
use PhpOption\Option;
use Psr\Log\LoggerInterface;
use Slim\App;
use Slim\Logger as DumpLogger;

if (! function_exists('json')) {
    /**
     * JSON response wrapper.
     */
    function json(mixed $data, int $status = 200, array $headers = []): JsonResponse
    {
        return new JsonResponse($data, $status, $headers);
    }
}

if (! function_exists('env')) {
    /**
     * Get the environment value.
     */
    function env(string $param, mixed $default = null): mixed
    {
        $value = $_ENV[$param] ?? $_SERVER[$param] ?? $default;
        if ($value === $default) {
            return $value;
        }
        return Option::fromValue($value)->map(fn ($value) => match (strtolower($value)) {
            'false' => false,
            'true'  => true,
            'null'  => null,
            default => $value,
        })->get();
    }
}

if (! function_exists('is_debug_enabled')) {
    /**
     * Check whether DEBUG environment variable is set.
     */
    function is_debug_enabled(): bool
    {
        return (bool) env('DEBUG', false);
    }
}

if (! function_exists('logger')) {
    /**
     * Get the application logger.
     *
     * This function checks the app container for the logger firstly
     * and if it's missing creates a very simple one.
     */
    function logger(App $app): LoggerInterface
    {
        $container = $app->getContainer();
        return $container?->has(LoggerInterface::class)
             ? $container->get(LoggerInterface::class) : new DumpLogger();
    }
}