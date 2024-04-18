<?php

namespace Tests\Feature\Api\V1\Track;

use App\Models\Album;
use App\Models\Singer;
use App\Models\Track;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TrackIndexTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        Track::factory(10)->for(Album::factory()->for(Singer::factory()))->create();
    }
    /**
     * A basic feature test example.
     */
    public function test_api_tracks_index(): void
    {
        $response = $this->get('/api/v1/tracks');
        $response->assertJsonStructure([
            "tracks" => [
                "*" => [
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
            ]
        ]);
        $response->assertOk();
    }
}
