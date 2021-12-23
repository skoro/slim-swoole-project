<?php declare(strict_types=1);

use Laminas\Diactoros\Response\JsonResponse;

/**
 * JSON response wrapper.
 */
function json(mixed $data, int $status = 200, array $headers = []): JsonResponse
{
    return new JsonResponse($data, $status, $headers);
}

/**
 * Get the environment value.
 *
 * @return mixed|null
 */
function env(string $param, mixed $default = null)
{
    return $_ENV[$param] ?? $_SERVER[$param] ?? $default;
}

/**
 * Check whether DEBUG environment variable is set.
 */
function is_debug_enabled(): bool
{
    return (bool) env('DEBUG', false);
}
