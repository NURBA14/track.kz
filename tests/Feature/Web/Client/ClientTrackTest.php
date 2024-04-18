<?php

namespace Tests\Feature\Web\Client;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClientTrackTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_client_tracks_page(): void
    {
        $response = $this->get(route("client.track.index"));
        $response->assertSee("Tracks");
        $response->assertViewIs("client.track.index");
        $response->assertOk();
    }
}
