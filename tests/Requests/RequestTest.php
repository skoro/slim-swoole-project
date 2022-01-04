<?php declare(strict_types=1);

namespace Tests\Requests;

use Tests\TestCase;

class RequestTest extends TestCase
{
    /** @test */
    public function it_returns_status_ok_from_index_route(): void
    {
        $response = $this->getJson('/');

        $response->assertStatusCode(200);
        $this->assertEquals(['status' => 'ok'], $response->asJson());
    }

    /** @test */
    public function requesting_non_existing_route_returns_404(): void
    {
        $response = $this->getJson('/not-found-page');

        $response->assertStatusCode(404);
        $this->assertEquals(['message' => '404 Not Found'], $response->asJson());
    }
}