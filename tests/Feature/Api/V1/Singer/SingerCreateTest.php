<?php

namespace Tests\Feature\Api\V1\Singer;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SingerCreateTest extends TestCase
{
    use RefreshDatabase;
    public function test_api_singer_create(): void
    {
        $user = User::factory()->createOne([
            "is_admin" => 1
        ]);
        $response = $this->actingAs($user)->post('/api/v1/singers', [
            "name" => "Singer name"
        ]);
        $response->assertJsonStructure([
            "singer" => [
                "id",
                "name",
                "albums_count",
                "created_at",
                "albums" => []
            ]
        ]);
        $response->assertStatus(201);
    }
}
