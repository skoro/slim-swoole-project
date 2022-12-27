<?php

declare(strict_types=1);

namespace Tests\Support;

use Laminas\Diactoros\ServerRequest;
use Laminas\Diactoros\Uri;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * This trait adds to a test case sending http requests to the application.
 */
trait SendRequest
{
    /**
     * @param array<string, string> $headers
     */
    protected function get(string $path, array $headers = []): TestResponse
    {
        return $this->submitRequest(
            $this->createRequest('GET', $path, $headers)
        );
    }

    /**
     * @param array<string, string> $headers
     */
    protected function getJson(string $path, array $headers = []): TestResponse
    {
        return $this->get($path, ['Accept' => 'application/json'] + $headers);
    }

    /**
     * @param null|array<mixed>|object $body
     * @param array<string, string> $headers
     */
    protected function post(string $path, $body, array $headers = []): TestResponse
    {
        return $this->submitRequest(
            $this->createRequest('POST', $path, $headers, parsedBody: $body)
        );
    }

    private function submitRequest(Request $request): TestResponse
    {
        return new TestResponse($this, $this->app->handle($request));
    }

    /**
     * @param array<string, string> $headers
     * @param array<string, string> $cookies
     * @param array<string, string> $serverParams
     * @param array<mixed>|object|null $parsedBody
     */
    private function createRequest(
        string $method,
        string $path,
        array $headers = [],
        array $cookies = [],
        array $serverParams = [],
        null|array|object $parsedBody = null,
    ): Request {
        $uri = new Uri($path);
        parse_str($uri->getQuery(), $query);

        return new ServerRequest(
            serverParams: $serverParams,
            uri: $uri,
            method: $method,
            headers: $headers,
            cookieParams: $cookies,
            parsedBody: $parsedBody,
            body: 'php://temp',
            queryParams: $query,
        );
    }
}
