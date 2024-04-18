<?php

namespace Tests\Feature\Api\V1\Singer;

use App\Models\Singer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SingerDeleteTest extends TestCase
{
    use RefreshDatabase;
    protected static $singer;
    public function setUp(): void
    {
        parent::setUp();
        self::$singer = Singer::factory()->createOne();
    }
    /**
     * A basic feature test example.
     */
    public function test_api_singers_delete(): void
    {
        $id = self::$singer->id;
        $user = User::factory()->createOne([
            "is_admin" => 1
        ]);
        $response = $this->actingAs($user)->delete("/api/v1/singers/{$id}");
        $response->assertJson([
            "message" => "success"
        ]);
        $response->assertOk();
    }
}
