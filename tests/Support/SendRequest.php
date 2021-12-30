<?php declare(strict_types=1);

namespace Tests\Support;

use Laminas\Diactoros\ServerRequest;
use Laminas\Diactoros\Uri;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * This trait adds to a test case sending http requests to the application.
 */
trait SendRequest
{
    /**
     * @param array<string, string> $headers
     */
    protected function get(string $path, array $headers = []): Response
    {
        return $this->submitRequest(
            $this->createRequest('GET', $path, $headers)
        );
    }

    /**
     * @param array<string, string> $headers
     */
    protected function getJson(string $path, array $headers = []): mixed
    {
        return $this->getResponseAsJson(
            $this->get($path, ['HTTP_ACCEPT' => 'application/json'] + $headers)
        );
    }

    /**
     * @param null|array<mixed>|object $body
     * @param array<string, string> $headers
     */
    protected function post(string $path, $body, array $headers = []): Response
    {
        return $this->submitRequest(
            $this->createRequest('POST', $path, $headers, parsedBody: $body)
        );
    }

    private function submitRequest(Request $request): Response
    {
        return $this->app->handle($request);
    }

    private function getResponseAsJson(Response $response): mixed
    {
        return json_decode($response->getBody()->getContents(), associative: true, flags: JSON_THROW_ON_ERROR);
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
        $uri = new Uri();
        $uri = $uri->withPath($path);

        return new ServerRequest(
            serverParams: $serverParams,
            uri: $uri,
            method: $method,
            headers: $headers,
            cookies: $cookies,
            parsedBody: $parsedBody,
            body: 'php://temp',
        );
    }
}