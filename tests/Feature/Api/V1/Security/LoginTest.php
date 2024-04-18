<?php

namespace Tests\Feature\Api\V1\Security;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    protected static $user;
    public function setUp(): void
    {
        parent::setUp();
        self::$user = User::factory()->createOne();
    }

    public function test_api_security_login(): void
    {
        $response = $this->post("/api/v1/login", [
            "email" => self::$user->email,
            "password" => "password"
        ]);
        $response->assertJsonStructure([
            "token"
        ]);
        $response->assertOk();
    }
}
