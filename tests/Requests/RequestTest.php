<?php declare(strict_types=1);

namespace Tests\Requests;

use Tests\TestCase;

class RequestTest extends TestCase
{
    /** @test */
    public function it_returns_status_ok_from_index_route(): void
    {
        $payload = $this->getJson('/');

        $this->assertEquals(['status' => 'ok'], $payload);
    }

    /** @test */
    public function requesting_non_existing_route_returns_404(): void
    {
        $response = $this->get('/not-found-page');

        $this->assertEquals(404, $response->getStatusCode());
    }
}