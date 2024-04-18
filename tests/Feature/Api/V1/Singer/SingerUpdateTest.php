<?php

namespace Tests\Feature\Api\V1\Singer;

use App\Models\Singer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SingerUpdateTest extends TestCase
{
    use RefreshDatabase;
    protected static $singer;

    public function setUp(): void
    {
        parent::setUp();
        self::$singer = Singer::factory()->createOne();
    }
    public function test_api_singers_update(): void
    {
        $id = self::$singer->id;
        $user = User::factory()->createOne([
            "is_admin" => 1
        ]);
        $response = $this->actingAs($user)->put("/api/v1/singers/{$id}", [
            "name" => "New Name"
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
        $response->assertJson([
            "singer" => [
                "id" => self::$singer->id,
                "name" => "New Name",
                "albums_count" => self::$singer->albums()->count(),
                "created_at" => self::$singer->created_at,
                "albums" => []
            ]
        ]);
        $response->assertStatus(200);
    }
}
