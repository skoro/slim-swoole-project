<?php

declare(strict_types=1);

namespace Tests\Requests;

use Tests\TestCase;

class RequestTest extends TestCase
{
    public function testItReturnsStatusOkFromIndexRoute(): void
    {
        $response = $this->getJson('/');
        $response->assertStatusCode(200);
        $this->assertEquals(['status' => 'ok'], $response->asArray());
    }

    /** @test */
    public function testRequestingNonExistingRouteReturns404(): void
    {
        $response = $this->getJson('/not-found-page');
        $response->assertStatusCode(404);
        $this->assertArrayHasKey('message', $response->asArray());
        $this->assertEquals('404 Not Found', $response->asArray()['message']);
    }
}
