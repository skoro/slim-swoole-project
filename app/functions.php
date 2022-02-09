<?php

/**
 * Global functions.
 */

declare(strict_types=1);

use Laminas\Diactoros\Response\JsonResponse;
use PhpOption\Option;
use Psr\Log\LoggerInterface;
use Slim\App;
use Slim\Logger as DumpLogger;

if (! defined('ROOT_DIR')) {
    define('ROOT_DIR', dirname(__DIR__));
}
if (! defined('APP_DIR')) {
    define('APP_DIR', ROOT_DIR . '/app/');
}
if (! defined('VAR_DIR')) {
    define('VAR_DIR', ROOT_DIR . '/var/');
}
if (! defined('SRC_DIR')) {
    define('SRC_DIR', ROOT_DIR . '/src/');
}

if (! function_exists('json')) {
    /**
     * JSON response wrapper.
     *
     * @param array<string, string> $headers
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
            'false'     => false,
            'true'      => true,
            '', 'null'  => null,
            default     => $value,
        })->get() ?? $default;
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
     * This function checks the src container for the logger firstly
     * and if it's missing creates a very simple one.
     */
    function logger(App $app): LoggerInterface
    {
        $container = $app->getContainer();
        return $container?->has(LoggerInterface::class)
             ? $container->get(LoggerInterface::class) : new DumpLogger();
    }
}

if (! function_exists('unique_id')) {
    /**
     * Generate a unique id.
     *
     * @see random_bytes()
     * @throws Exception When an appropriate source of randomness cannot be found.
     */
    function unique_id(int $length = 8): string
    {
        return bin2hex(random_bytes($length));
    }
}

if (! function_exists('class_basename')) {
    /**
     * Get the class "basename" of the given object / class.
     */
    function class_basename(string|object $class): string
    {
        $class = is_object($class) ? get_class($class) : $class;
        return basename(str_replace('\\', '/', $class));
    }
}
