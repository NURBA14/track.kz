<?php

namespace Tests\Feature\Api\V1\Album;

use App\Models\Album;
use App\Models\Singer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AlbumUpdateTest extends TestCase
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
    public function test_api_albums_update(): void
    {
        $id = self::$album->id;
        $user = User::factory()->createOne([
            "is_admin" => 1
        ]);
        $response = $this->actingAs($user)->put("/api/v1/albums/{$id}", [
            "name" => "New Name",
            "singer_id" => self::$album->singer->id,
            "date" => now(),
        ]);
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
                "name" => 'New Name',
                "img" => asset(self::$album->getImage()),
                "singer" => [
                    "id" => self::$album->singer->id,
                    "name" => self::$album->singer->name
                ],
                "tracks_count" => self::$album->tracks()->count(),
                "tracks" => self::tracks()->toArray()
            ]
        ]);
        $response->assertStatus(200);
    }
}
