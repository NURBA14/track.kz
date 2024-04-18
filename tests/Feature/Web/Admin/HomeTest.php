<?php

namespace Tests\Feature\Web\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use RefreshDatabase;
    public function test_admin_home(): void
    {
        $user = User::factory()->createOne([
            "is_admin" => 1
        ]);
        $response = $this->actingAs($user)->get(route("admin.home"));
        $response->assertSee("Home");
        $response->assertViewIs("admin.index");
        $response->assertOk();
    }
}
