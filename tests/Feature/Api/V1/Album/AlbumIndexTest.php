<?php

namespace Tests\Feature\Api\V1\Album;

use App\Models\Album;
use App\Models\Singer;
use App\Models\Track;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AlbumIndexTest extends TestCase
{
    use RefreshDatabase;
    public function setUp(): void
    {
        parent::setUp();
        Album::factory(5)->for(Singer::factory())->has(Track::factory(2))->create();
    }
    public function test_api_albums_index(): void
    {
        $response = $this->get('/api/v1/albums');
        $response->assertJsonStructure([
            "albums" => [
                "*" => [
                    "id",
                    "name",
                    "singer" => [
                        "id",
                        "name"
                    ],
                    "img",
                    "tracks_count",
                    "date",
                    "created_at"
                ]
            ]
        ]);
        $response->assertOk();
    }
}
