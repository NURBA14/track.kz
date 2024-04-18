<?php

namespace Tests\Feature\Api\V1\Singer;

use App\Models\Album;
use App\Models\Singer;
use App\Models\Track;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SingerShowTest extends TestCase
{
    use RefreshDatabase;
    protected static $singer;
    public function setUp(): void
    {
        parent::setUp();
        self::$singer = Singer::factory()->has(Album::factory(2))->createOne();
    }

    public static function albums()
    {
        return self::$singer->albums->map(fn($album) => [
            "id" => $album->id,
            "name" => $album->name,
            "img" => asset($album->getImage()),
            "tracks_count" => $album->tracks()->count(),
            "date" => $album->date,
            "created_at" => $album->created_at
        ]);
    }
    /**
     * A basic feature test example.
     */
    public function test_api_singers_show(): void
    {
        $id = self::$singer->id;
        $response = $this->get("api/v1/singers/{$id}");
        $response->assertJsonStructure([
            "singer" => [
                "id",
                "name",
                "albums_count",
                "created_at",
                "albums" => [
                    "*" => [
                        "id",
                        "name",
                        "img",
                        "tracks_count",
                        "date",
                        "created_at"
                    ]
                ]
            ]
        ]);
        $response->assertJson([
            "singer" => [
                "id" => self::$singer->id,
                "name" => self::$singer->name,
                "albums_count" => self::$singer->albums()->count(),
                "created_at" => self::$singer->created_at,
                "albums" => self::albums()->toArray()
            ]
        ]);
        $response->assertStatus(200);
    }
}
