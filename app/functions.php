<?php declare(strict_types=1);

use Laminas\Diactoros\Response\JsonResponse;
use PhpOption\Option;

/**
 * JSON response wrapper.
 */
function json(mixed $data, int $status = 200, array $headers = []): JsonResponse
{
    return new JsonResponse($data, $status, $headers);
}

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

/**
 * Check whether DEBUG environment variable is set.
 */
function is_debug_enabled(): bool
{
    return (bool) env('DEBUG', false);
}
