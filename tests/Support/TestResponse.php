<?php

declare(strict_types=1);

namespace Tests\Support;

use JsonException;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\StreamInterface;

class TestResponse implements Response
{
    public function __construct(private TestCase $testCase, private Response $response)
    {
    }

    public function assertStatusCode(int $expectedStatusCode): void
    {
        $this->testCase->assertEquals($expectedStatusCode, $this->response->getStatusCode());
    }

    /**
     * Converts the JSON response to an array.
     *
     * @throws JsonException When the response content cannot be converted to a JSON.
     */
    public function asArray(): mixed
    {
        return json_decode($this->asString(), associative: true, flags: JSON_THROW_ON_ERROR);
    }

    public function asString(): string
    {
        $body = $this->response->getBody();
        if ($body->isSeekable()) {
            $body->rewind();
        }
        return $body->getContents();
    }

    public function getProtocolVersion(): string
    {
        return $this->response->getProtocolVersion();
    }

    public function withProtocolVersion($version): Response
    {
        return $this->response->withProtocolVersion($version);
    }

    public function getHeaders(): array
    {
        return $this->response->getHeaders();
    }

    public function hasHeader($name): bool
    {
        return $this->response->hasHeader($name);
    }

    public function getHeader($name): array
    {
        return $this->response->getHeader($name);
    }

    public function getHeaderLine($name): string
    {
        return $this->response->getHeaderLine($name);
    }

    public function withHeader($name, $value): Response
    {
        return $this->response->withHeader($name, $value);
    }

    public function withAddedHeader($name, $value): Response
    {
        return $this->withAddedHeader($name, $value);
    }

    public function withoutHeader($name): Response
    {
        return $this->response->withoutHeader($name);
    }

    public function getBody(): StreamInterface
    {
        return $this->response->getBody();
    }

    public function withBody(StreamInterface $body): Response
    {
        return $this->response->withBody($body);
    }

    public function getStatusCode(): int
    {
        return $this->response->getStatusCode();
    }

    public function withStatus($code, $reasonPhrase = ''): Response
    {
        /** @phpstan-ignore-next-line */
        return $this->response->withStatus($code, $reasonPhrase);
    }

    public function getReasonPhrase(): string
    {
        return $this->response->getReasonPhrase();
    }
}
