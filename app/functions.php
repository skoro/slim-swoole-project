<?php declare(strict_types=1);

use Laminas\Diactoros\Response\JsonResponse;

function json($data, int $status = 200, array $headers = []): JsonResponse
{
    return new JsonResponse($data, $status, $headers);
}
