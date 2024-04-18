<?php

namespace Tests\Feature\Api\V1\Album;

use App\Models\Album;
use App\Models\Singer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AlbumShowTest extends TestCase
{
    use RefreshDatabase;
    protected static $album;
    public function setUp(): void
    {
        parent::setUp();
        self::$album = Album::factory()->for(Singer::factory())->createOne();
    }
    public static function tracks()
    {
        return self::$album->tracks->map(fn($track) => [
            "id" => $track->id,
            "name" => $track->name,
            "track" => asset($track->getTrack()),
            "views" => $track->views,
            "created_at" => $track->created_at
        ]);
    }
    public function test_api_albums_show(): void
    {
        $id = self::$album->id;
        $response = $this->get("/api/v1/albums/{$id}");
        $response->assertJsonStructure([
            "album" => [
                "id",
                "name",
                "img",
                "singer" => [
                    "id",
                    "name"
                ],
                "tracks_count",
                "tracks" => []
            ]
        ]);
        $response->assertJson([
            "album" => [
                "id" => self::$album->id,
                "name" => self::$album->name,
                "img" => asset(self::$album->getImage()),
                "singer" => [
                    "id" => self::$album->singer->id,
                    "name" => self::$album->singer->name
                ],
                "tracks_count" => self::$album->tracks()->count(),
                "tracks" => self::tracks()->toArray()
            ]
        ]);
        $response->assertOk();
    }
}
