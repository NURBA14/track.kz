<?php

namespace Tests\Feature\Web\Security;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_security_reg_form(): void
    {
        $response = $this->get(route("security.reg.index"));
        $response->assertSee("Sign Up");
        $response->assertViewIs("security.reg");
        $response->assertStatus(200);
    }

    public function test_secutiry_reg_store(): void
    {
        $response = $this->withSession([
            '_token' => "wasd",
        ])->post(route("security.reg.store", [
            '_token' => "wasd",
            "email" => "murad@gmail.com",
            "name" => "Nurba",
            "password" => "123",
            "password_confirmation" => "123"
        ]));
        $response->assertRedirectToRoute("client.home");
        $response->assertSessionHas("success", "You are logged");
        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);
    }
}
