<?php

namespace Tests\Feature\Api\V1\Track;

use App\Models\Album;
use App\Models\Singer;
use App\Models\Track;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TrackShowTest extends TestCase
{
    use RefreshDatabase;

    protected static $track;
    public function setUp(): void
    {
        parent::setUp();
        self::$track = Track::factory()->for(Album::factory()->for(Singer::factory()))->createOne();
    }
    public function test_api_tracks_show(): void
    {
        $id = self::$track->id;
        $response = $this->get("/api/v1/tracks/{$id}");
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
                "name" => self::$track->name,
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
        $response->assertOk();
    }
}
