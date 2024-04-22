<?php

namespace Tests\Feature\Web\Security;

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
    /**
     * A basic feature test example.
     */
    public function test_security_login_form(): void
    {
        $response = $this->get(route("security.login.index"));
        $response->assertSee("Log in");
        $response->assertViewIs("security.login");
        $response->assertOk();
    }

    public function test_security_login_store(): void
    {
        $response = $this->withSession([
            '_token' => "wasd",
        ])->post(route("security.login.store", [
            '_token' => "wasd",
            "email" => self::$user->email,
            "password" => "password"
        ]));
        $response->assertRedirectToRoute("client.home");
        $response->assertSessionHas("success", "You are logged");
        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);
    }

    public function test_security_logout(): void
    {
        $response = $this
        ->withSession([
            '_token' => "wasd",
        ])->post(route("security.logout", [
            '_token' => "wasd",
        ]));
        $response->assertRedirectToRoute("security.login.index");
        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);
    }
}
