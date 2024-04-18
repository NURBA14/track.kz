<?php

namespace Tests\Feature\Web\Client;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClientHomeTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_client_home_page(): void
    {
        $response = $this->get(route("client.home"));
        $response->assertSee("Home");
        $response->assertViewIs("client.index"); 
        $response->assertOk();
    }
}
