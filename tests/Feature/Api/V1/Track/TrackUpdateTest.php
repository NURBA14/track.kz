<?php

namespace Tests\Feature\Api\V1\Track;

use App\Models\Album;
use App\Models\Singer;
use App\Models\Track;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TrackUpdateTest extends TestCase
{
    use RefreshDatabase;
    protected static $track;
    public function setUp(): void
    {
        parent::setUp();
        self::$track = Track::factory()->for(Album::factory()->for(Singer::factory()))->createOne();
    }
    public function test_api_tracks_update(): void
    {
        $id = self::$track->id;
        $user = User::factory()->createOne([
            "is_admin" => 1
        ]);
        $response = $this->actingAs($user)->put("/api/v1/tracks/{$id}", [
            "name" => "New Name",
            "album_id" => self::$track->album->id,
        ]);
        $response->assertJsonStructure([
            "track" => [
                "id",
                "name",
                "track",
                "views",
                "album" => [
                    "id",
                    "name"
                ],
                "singer" => [
                    "id",
                    "name"
                ],
                "created_at"
            ]
        ]);
        $response->assertJson([
            "track" => [
                "id" => self::$track->id,
                "name" => "New Name",
                "track" => asset(self::$track->getTrack()),
                "views" => self::$track->views,
                "album" => [
                    "id" => self::$track->album->id,
                    "name" => self::$track->album->name
                ],
                "singer" => [
                    "id" => self::$track->album->singer->id,
                    "name" => self::$track->album->singer->name
                ],
                "created_at" => self::$track->created_at
            ]
        ]);
        $response->assertStatus(200);
    }
}
