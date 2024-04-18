<?php

namespace Tests\Feature\Api\V1\Security;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegTest extends TestCase
{
    use RefreshDatabase;
    public function test_api_security_register(): void
    {
        $response = $this->post('/api/v1/register', [
            "name" => "Name",
            "email" => "mura@gmail.com",
            "password" => "123"
        ]);
        $response->assertJsonStructure([
            "message",
            "token"
        ]);
        $response->assertOk();
    }
}
